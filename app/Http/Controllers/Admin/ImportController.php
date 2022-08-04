<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\HtusImport;
use App\Models\Htus;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ImportController extends Controller
{
    public function fileImport(Request $request)
    {
        Excel::import(new HtusImport, $request->file('file')->store('temp'));
        return back();
    }

    public function allHtus(Request $request)
    {
        if ($request->ajax()) {
            $htuses = Htus::latest()->get();

            return DataTables::of($htuses)
                ->addIndexColumn()
                ->addColumn('image', function($htuses){
                    return "<img src='".$htuses->image."' alt='".$htuses->image."' />";
                })
                ->addColumn('classification_justification', function($htuses){
                    return Str::limit($htuses->classification_justification,30);
                })
                ->addColumn('action', function($htuses) {
                    return '<button type="button" class="btn btn-success btn-sm" id="getEditProductData" data-id="'.$htuses->id.'">Edit</button>
                        <button type="button" data-id="'.$htuses->id.'" class="btn btn-danger btn-sm" id="getDeleteId">Delete</button>';
                })
                ->rawColumns(['image','action'])
                ->make(true);
        }

        return view('admin.dashboard');
    }

    public function update(Request $request, $id){
        try{
            $data = Htus::find($id);
            if(!$data){
                return response()->json(["status"=> false, "message"=> "Item not found."]);
            }
            $data->comments = $request->comments ?? "n\a";
            $data->save();

            return response()->json(["status"=> true]);

        }catch(Exception $e){
            Log::error($e);
        }
    }

    public function get(Request $request, $id){
        $data = Htus::find($id);
        $html = "";
        if($data){
            $html = '<div class="form-group">';
            $html .= '<input type="text" class="form-control" id="comments" name="comment" value="'.$data->comments.'" />';
            $html .= '</div>';
        }

        return response()->json(['html' => $html]);

    }

    public function delete(Request $request, $id){

        $data = Htus::find($id);
        if($data){
            $data->delete();
        }

        return response()->json(['html' => ""]);
    }
}

