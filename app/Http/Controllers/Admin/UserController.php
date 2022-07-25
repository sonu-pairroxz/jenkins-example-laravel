<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests\UserRequest;
use App\Traits\ImageTrait;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    use ImageTrait;

    /**
     * UserController constructor.
     * @param
     */
    public function __construct(User $user){
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try {
            $input = request()->except(['_token']);
            if($request->hasFile('image')){
                $folder_name ='user';
                $input['image'] = $this->fileUpload($request->file('image'),false,$folder_name);
            }
            $input['password'] = Hash::make($input['password']);
            $this->user->create($input);
            Session::flash('success',trans('You have been created user successfully'));
            return redirect(route('user.index'));
        } catch (Exception $e) {
            Log::error($e);
            Session::flash('error',$e->getMessage());
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = $this->user->with('orders')->findOrFail($id);
            $orders = $user->orders()->paginate(10)->withQueryString();
            return view('admin.users.view',compact('user','orders'));
        }catch (\Exception $e){
            Log::error($e);
            return abort(500);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $user = $this->user->findOrFail($id);
            return view('admin.users.edit', compact('user'));
        }
        catch (Exception $e){
            Log::error($e);
            return abort(500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $input = request()->except(['_token']);
            if($request->hasFile('image')){
                $folder_name ='user';
                $input['image'] = $this->fileUpload($request->file('image'),false,$folder_name);
            }
            $user = $this->user->findOrFail($id);
            if (trim($input['password']) != '') {
               $user->password = Hash::make(trim($input['password']));
            }
            $user->name = $input['name'];
            $user->email = $input['email'];
            $user->save();
            return redirect(route('user.index'))->with('success', trans('You have been successfully updated user'));
        } catch (Exception $e) {
            Log::error($e);
            Session::flash('error',$e->getMessage());
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = $this->user->findOrFail($id);
            $user->delete();
            return redirect(route('user.index'))->with('success', trans('You have been successfully deleted user'));
        }catch (Exception $e){
            Log::error($e);
            return abort(500);
        }
    }

    public function data(Request $request){
        try {
            $user = $this->user->where('id','!=', 1)->select(\DB::raw("CONCAT(first_name,' ',last_name) AS name"),"email","id","created_at","mobile_no")->latest()->get();
            //dd($user);
            return DataTables::of($user)
                ->addIndexColumn()
                ->addColumn('created_at',function ($user){
                    return Carbon::parse($user->created_at)->format('Y-m-d');
                })
                ->addColumn('actions','<a class="btn btn-outline-success btn-sm eye" href="{{route(\'user.show\',$id)}}" title="View"><i class="fas fa-eye"></i></a>&nbsp;<a class="btn btn-outline-danger btn-sm trash" href="{{route(\'user.delete\',$id)}}" title="Delete" onclick="return confirm(\'Are you sure want to remove this user? \')"><i class="fas fa-trash-alt"></i></a>')
                ->rawColumns(['actions'])
                ->make(true);
        }catch (Exception $e){
            Log::error($e);
        }
    }


    public function getModalDelete($id = null){
        $model = 'User';
        $confirm_route = $error = null;
        $confirm_route = route('user.destroy', $id);
        return view('admin.layouts.delete_modal_confirmation', compact('error', 'model', 'confirm_route'));
    }
}
