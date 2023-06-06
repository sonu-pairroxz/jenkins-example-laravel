<?php

namespace App\Http\Controllers\Admin;

use App\Exports\JitLearningExport;
use App\Http\Controllers\Controller;
use App\Jobs\ImportQuizJitLearning;
use App\Models\JitLearning;
use App\Models\JitLearningNotification;
use App\Traits\ImageTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class JitLearningController extends Controller
{
    use ImageTrait;
    public function index()
    {
        $notifications = JitLearningNotification::latest()->get();
        return view('admin.jit-learning.index', compact('notifications'));
    }

    public function create()
    {
        return view('admin.jit-learning.create');
    }

    public function store(Request $request)
    {
        try{

            $user = auth()->guard('admin')->user();
            $input = $request->all();
            $input['ticket_id'] = time();

            DB::beginTransaction();

            if($request->hasFile('image')){
                $folder_name ='jit-learning';
                $input['image'] = $this->fileUpload($request->file('image'),false,$folder_name);
            }

            $jitlearning = $user->jitLearning()->create($input);

            //Save Notification
            $notification = [
                "user_id" => $user->id,
                "title" => "Quiz/JIT learning added.",
                "description" => "New Quiz/JIT learning added.",
                "notification_text" => sprintf("%s has added a new quiz/JIT learning with ID %s", $user->first_name, $jitlearning->ticket_id)
            ];
            $jitlearning->notification()->create($notification);

            DB::commit();
            return back()->with(["message"=>"Jit Learning added successfully"]);

        }catch(Exception $e){
            return $e;
            Log::error($e);
            DB::rollBack();
            return back()->with(["error_message"=> $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $data = JitLearning::find($id);
        if(!$data){
            return back()->with(["error_message"=>"Jit Learning not found"]);
        }
        return view('admin.jit-learning.show', compact('data'));
    }

    public function edit($id)
    {
        try{
            $jitlearning = JitLearning::find($id);
            if(!$jitlearning){
                return back()->with(["error_message"=>"Jit Learning not found"]);
            }
            return view('admin.jit-learning.edit', compact('jitlearning'));
        }catch(Exception $e){
            Log::error($e);
            return back()->with(["error_message"=> $e->getMessage()]);
        }
        // return view('admin.jit-learning.edit');
    }

    public function update(Request $request, $id)
    {
        try{
            $user = auth()->guard('admin')->user();
            DB::beginTransaction();
            $jitlearning = $user->jitLearning()->find($id);
            if(!$jitlearning){
                return back()->with(['error_message', "Jit Learning not found."]);
            }
            $input = $request->all();

            $jitlearning->update($input);


             //Save Notification
             $notification = [
                "user_id" => $user->id,
                "title" => "Quiz/JIT learning updated.",
                "description" => "New Quiz/JIT learning updated.",
                "notification_text" => sprintf("%s has been updated a quiz/JIT learning with ID %s", $user->first_name, $jitlearning->ticket_id)
            ];
            $jitlearning->notification()->create($notification);

            DB::commit();
            return redirect(route('jit-learning.index'))->with(["message"=>"Jit Learning updated successfully"]);

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
            $jitLearnings = JitLearning::latest()->get();
            //dd($user);
            return DataTables::of($jitLearnings)
                ->addIndexColumn()
                ->addColumn('ticket_id', function ($jitLearnings) {
                    $route = route('jit-learning.edit', $jitLearnings->id);
                    return "<a href='" . $route . "'>" . $jitLearnings->ticket_id . "</a>";
                })
                ->addColumn('asin', function ($jitLearnings) {
                    $img = "https://images.amazon.com/images/P/".$jitLearnings->asin."._SCMZZZZZZZ_.jpg";
                    $image = '<img src="'.$img.'" height="50" width="50">';

                    return "<a href='javascript:void(0);' data-id='". $img."' onClick='showImageModal(this);'>".$image."</a>";
                })
                ->addColumn('correct_code', function($jitLearnings){
                    return '<p style="color:green">'.$jitLearnings->correct_code.'</p>';
                })
                ->addColumn('incorrect_code', function($jitLearnings){
                    return '<p style="color:red">'.$jitLearnings->incorrect_code.'</p>';
                })
                ->addColumn('actions','<a class="btn btn-outline-primary btn-sm" href="{{route(\'jit-learning.edit\',$id)}}" title="Edit"><i class="fas fa-pencil-alt"></i></a><a class="btn btn-outline-primary btn-sm" href="{{route(\'jit-learning.show\',$id)}}" title="Edit"><i class="fas fa-eye"></i></a>')
                ->rawColumns(['actions','ticket_id','correct_code','incorrect_code','asin'])
                ->make(true);
        }catch (Exception $e){
            Log::error($e);
        }
    }

    public function export()
    {
        try{
            $jitlearning = JitLearning::latest()->get();
            return Excel::download(new JitLearningExport($jitlearning), 'quiz-jit-learning'.date("Y-m-d").'.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        }catch(Exception $e){
            Log::error($e);
            return back()->with(['error_message'=> "Oops! Something went wrong. Try again."]);
        }
    }

    public function removeAll()
    {
        try{
            JitLearningNotification::query()->delete();
            JitLearning::query()->delete();
            return redirect(route('jit-learning.index'))->with(["message"=>"All Quiz/JIT Learning removed successfully"]);
        }catch(Exception $e){
            Log::error($e);
            return back()->with(['error_message'=> "Oops! Something went wrong. Try again."]);
        }
    }

    public function fileImport(Request $request)
    {
        try {
            if ($request->hasFile('file')) {
                $file = Storage::disk('public')->put(
                    'files',
                    $request->file('file')
                );
                // dd($file);
                Log::info('File Path: ' . Storage::path($file));
                dispatch_sync(new ImportQuizJitLearning(Storage::path($file)));
                return back()->with([
                    'message' =>
                        'File has been uploaded successfully. The file is being processed in the background',
                ]);
            } else {
                return back()->with([
                    'error_message' => 'Kindly choose file to import.',
                ]);
            }
        } catch (Exception $e) {
            Log::error($e);
            return back()->with([
                'error_message' => 'Oops! Something went wrong. Try again.',
            ]);
        }
    }

}
