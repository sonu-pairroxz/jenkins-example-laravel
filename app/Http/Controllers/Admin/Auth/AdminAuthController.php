<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Support\Facades\{Log,Session};
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class AdminAuthController extends Controller
{
  	use AuthenticatesUsers;

  	/**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
    }

    public function index()
    {
        return view('admin.auth.login');
    }

    /**
     * Show the application loginprocess.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        try {
            if (auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')]))
            {
                $user = auth()->guard('admin')->user();
                Session::flash('success','You are Login successfully!!');
                return redirect()->route('admin.dashboard');

            } else {
                return back()->with('error','Invalid Username/Password.');
            }
        }catch (\Exception $e){
            Log::error($e);
            return back()->with('error','Server Error Occured. Try Again!!');
        }

    }

    /**
     * Show the application logout.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        auth()->guard('admin')->logout();
        Session::flush();
        Session::flash('success','You are logout successfully');
        return redirect(route('adminLogin'));
    }
}
