<?php

namespace App\Http\Controllers\Admin;

use App\Exports\NewsExport;
use App\Http\Controllers\Controller;
use App\Models\News;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class NewsController extends Controller
{
    public function index()
    {
        return view('admin.news.index');
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        try{

            $user = auth()->guard('admin')->user();
            $input = $request->all();

            DB::beginTransaction();
            $news = $user->news()->create($input);

            DB::commit();
            return back()->with(["message"=>"News added successfully"]);

        }catch(Exception $e){
            return $e;
            Log::error($e);
            DB::rollBack();
            return back()->with(["error_message"=> $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $data = News::find($id);
        if(!$data){
            return back()->with(["error_message"=>"News not found"]);
        }
        return view('admin.news.show', compact('data'));
    }

    public function edit($id)
    {
        $news = News::find($id);
        if(!$news){
            return back()->with(["error_message"=>"News not found"]);
        }
        return view('admin.news.edit', compact('news'));
    }


    public function update(Request $request, $id)
    {
        try{
            $user = auth()->guard('admin')->user();
            DB::beginTransaction();
            $news = $user->news()->find($id);
            if(!$news){
                return back()->with(['error_message', "News not found."]);
            }
            $input = $request->all();

            $news->update($input);

            DB::commit();
            return redirect(route('news.index'))->with(["message"=>"News updated successfully"]);

        }catch(Exception $e){
            Log::error($e);
            DB::rollBack();
            return back()->with(["error_message"=> $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        //
    }


    public function data(Request $request){
        try {
            $news = News::latest()->get();
            //dd($user);
            return DataTables::of($news)
                ->addIndexColumn()
               ->addColumn('date_of_publish', function ($news) {
                    return Carbon::parse($news->date_of_publish)->format('d M, Y');
                })
                ->addColumn('date_of_change_applied', function ($news) {
                    return Carbon::parse($news->date_of_change_applied)->format('d M, Y');
                })
                ->addColumn('actions','<a class="btn btn-outline-primary btn-sm" href="{{route(\'news.edit\',$id)}}" title="Edit"><i class="fas fa-pencil-alt"></i></a><a class="btn btn-outline-primary btn-sm" href="{{route(\'news.show\',$id)}}" title="Edit"><i class="fas fa-eye"></i></a>')
                ->rawColumns(['actions','date_of_publish','date_of_change_applied'])
                ->make(true);
        }catch (Exception $e){
            Log::error($e);
        }
    }

    public function export()
    {
        try{
            $news = News::latest()->get();
            return Excel::download(new NewsExport($news), 'news'.date("Y-m-d").'.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        }catch(Exception $e){
            Log::error($e);
            return back()->with(['error_message'=> "Oops! Something went wrong. Try again."]);
        }
    }

    public function removeAll()
    {
        try{
            News::query()->delete();
            return redirect(route('news.index'))->with(["message"=>"All News removed successfully"]);
        }catch(Exception $e){
            Log::error($e);
            return back()->with(['error_message'=> "Oops! Something went wrong. Try again."]);
        }
    }

    public function uploadMedia(Request $request)
{
    if ($request->hasFile('upload')) {
        $originName = $request->file('upload')->getClientOriginalName();
        $fileName = pathinfo($originName, PATHINFO_FILENAME);
        $extension = $request->file('upload')->getClientOriginalExtension();
        $fileName = $fileName . '_' . time() . '.' . $extension;
        $path = storage_path('app/public/tmp/uploads');
        $fileName = $request->file('upload')->move($path, $fileName)->getFilename();

        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $url = asset('storage/tmp/uploads/' . $fileName);
        $msg = 'Image uploaded successfully';
        $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

        @header('Content-type: text/html; charset=utf-8');
        echo $response;
    }
    return false;
}


}
