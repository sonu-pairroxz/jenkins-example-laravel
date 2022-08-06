<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QueryRequest;
use App\Models\Query;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class QueryController extends Controller
{
    public function index(Request $request){
        return view('admin.query.index');
    }

    public function create(Request $request){
        return view('admin.query.create');
    }

    public function store(QueryRequest $request){
        try{
            $user = auth()->guard('admin')->user();
            $input = $request->all();
            DB::beginTransaction();
            $res = $user->userQuery()->create($input);

            DB::commit();
            return back()->with(["message"=>"Query submitted successfully"]);

        }catch(Exception $e){
            Log::error($e);
            DB::rollBack();
            return back()->with(["error_message"=> $e->getMessage()]);
        }
    }

    public function show(Request $request, $id){
        try{
            $user = auth()->guard('admin')->user();
            $query = $user->userQuery()->find($id);
            if(!$query){
                return back()->with(['error_message', "Query not found."]);
            }
            return view('admin.query.show', compact('query'));

        }catch(Exception $e){
            Log::error($e);
            return back()->with(["error_message"=> $e->getMessage()]);
        }
    }

    public function edit(Request $request, $id){
        try{
            $user = auth()->guard('admin')->user();
            $query = $user->userQuery()->find($id);
            if(!$query){
                return back()->with(['error_message', "Query not found."]);
            }
            return view('admin.query.edit', compact('query'));

        }catch(Exception $e){
            Log::error($e);
            return back()->with(["error_message"=> $e->getMessage()]);
        }
    }

    public function update(Request $request, $id){
        try{
            $user = auth()->guard('admin')->user();
            $input = $request->all();
            DB::beginTransaction();
            $query = $user->userQuery()->find($id);
            if(!$query){
                return back()->with(['error_message', "Query not found."]);
            }

            $query->update($input);

            DB::commit();
            return redirect(route('query.index'))->with(["message"=>"Query updated successfully"]);

        }catch(Exception $e){
            Log::error($e);
            DB::rollBack();
            return back()->with(["error_message"=> $e->getMessage()]);
        }
    }

    public function data(Request $request){
        try {
            $query = Query::latest()->get();
            //dd($user);
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('actions','<a class="btn btn-outline-primary btn-sm" href="{{route(\'query.edit\',$id)}}" title="Edit"><i class="fas fa-pencil-alt"></i></a>')
                ->rawColumns(['actions'])
                ->make(true);
        }catch (Exception $e){
            Log::error($e);
        }
    }


}
