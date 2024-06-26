<?php

namespace App\Http\Controllers\Admin;

use App\Exports\QueryExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\QueryRequest;
use App\Models\Notification;
use App\Models\Query;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class QueryController extends Controller
{
    public function index(Request $request){
        $notifications = Notification::latest()->get();
        return view('admin.query.index', compact('notifications'));
    }

    public function create(Request $request){
        return view('admin.query.create');
    }

    public function store(QueryRequest $request){
        try{
            $user = auth()->guard('admin')->user();
            $input = $request->all();
            $input['ticket_id'] = time();
            $input['status'] = 'Pending';
            DB::beginTransaction();
            $query = $user->userQuery()->create($input);

            //Save Notification
            $notification = [
                "user_id" => $user->id,
                "title" => "Query added",
                "description" => "New query submitted",
                "notification_text" => sprintf("%s has submitted a new query with ID %s", $user->first_name, $query->ticket_id)
            ];
            $query->notification()->create($notification);

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
            $input = $request->only(['manager_id','marketplace','resolver_comment','status']);
            DB::beginTransaction();
            $query = $user->userQuery()->find($id);
            if(!$query){
                return back()->with(['error_message', "Query not found."]);
            }

            $query->update($input);


             //Save Notification
             $notification = [
                "user_id" => $user->id,
                "title" => "Comment added",
                "description" => "New comment added on a query",
                "notification_text" => sprintf("%s has added a new comment on a query with ID %s", $user->first_name, $query->ticket_id)
            ];
            $query->notification()->create($notification);

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
                ->addColumn('ticket_id', function ($query) {
                    $route = route('query.edit', $query->id);
                    return "<a href='" . $route . "'>" . $query->ticket_id . "</a>";
                })
                ->addColumn('asin', function ($query) {
                    $img = "https://images.amazon.com/images/P/".$query->asin."._SCMZZZZZZZ_.jpg";
                    $image = '<img src="'.$img.'" height="50" width="50">';

                    return "<a href='javascript:void(0);' data-id='". $img."' onClick='showImageModal(this);'>".$image."</a>";
                })
                ->addColumn('work_stream', function($query){
                    //work_stream
                    switch($query->work_stream){
                        case 'DI-Daily':
                            $work_stream = '<p style="color:red">'.$query->work_stream.'</p>';
                            break;
                        case 'DI-Weekly':
                            $work_stream = '<p style="color:orange">'.$query->work_stream.'</p>';
                            break;
                        case 'Non DI':
                            $work_stream = '<p>'.$query->work_stream.'</p>';
                            break;
                        case 'Urgent':
                            $work_stream = '<p style="color:red">'.$query->work_stream.'</p>';
                            break;
                        case 'High':
                            $work_stream = '<p style="color:red">'.$query->work_stream.'</p>';
                            break;
                        case 'Medium':
                            $work_stream = '<p style="color:yellow">'.$query->work_stream.'</p>';
                            break;
                        case 'Low':
                            $work_stream = '<p style="color:green">'.$query->work_stream.'</p>';
                            break;
                        default:
                            $work_stream = $query->work_stream;
                            break;
                    }
                    return $work_stream;
                })
                ->addColumn('actions','<a class="btn btn-outline-primary btn-sm" href="{{route(\'query.edit\',$id)}}" title="Edit"><i class="fas fa-pencil-alt"></i></a>')
                ->rawColumns(['actions','ticket_id','work_stream','asin'])
                ->make(true);
        }catch (Exception $e){
            Log::error($e);
        }
    }

    public function export(){
        try{
            $query = Query::latest()->get();
            return Excel::download(new QueryExport($query), 'query_'.date("Y-m-d").'.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        }catch(Exception $e){
            Log::error($e);
            return back()->with(['error_message'=> "Oops! Something went wrong. Try again."]);
        }

    }

    public function removeAll(Request $request){
        try{
            Notification::query()->delete();
            Query::query()->delete();
            return redirect(route('query.index'))->with(["message"=>"All Query removed successfully"]);
        }catch(Exception $e){
            Log::error($e);
            return back()->with(['error_message'=> "Oops! Something went wrong. Try again."]);
        }
    }


}
