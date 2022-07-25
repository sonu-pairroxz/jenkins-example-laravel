<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerComplaint;
use App\Models\Zone;
use Validator;
use Input;
use Redirect;
use Auth;
use Session;    
use DateTime;
use DB;
use App\Models\User;
use Carbon\Carbon;
use Mail;
use Hash;
use URL;

class LoginController extends Controller
{
    //Login View Paqe -----
    public function index(){
     return view('auth.login');
    }
    public function doLogin(Request $request){

      return Redirect::intended('/dashboard');  
        $rules = array(
            'email'    => 'required|email',
            'password' => 'required'
        );
        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
        return Redirect::to('/')
            ->withErrors($validator)
            ->withInput(Input::except('password'));
        } else {
        $userdata = array(
            'email'     => Input::get('email'),
            'password'  => Input::get('password')
        );
            
        if (Auth::attempt($userdata)) {
            if(Auth::user()->status != '0'){
                
                Auth::user()->last_login = new DateTime();
                Auth::user()->last_login_ip = $request->ip();
                Auth::user()->save();
                Session::flash('success','You have been successfully login.');  
                return Redirect::intended('/dashboard');    
            }else{
                Session::flash('error','Your account is not enabled. please contact your administrator to access away.');           
                return Redirect::to('/');
            }
        } else {
             Session::flash('error','These credentials do not match our records.');         
            return Redirect::to('/');
        }         
      } 
    }

    //Logout user admin ----------------------
    public function logout(Request $request) {
      Auth::logout();
      return redirect('/');
    }

    public function redirectTo()
    {
      $finalRedirectionTo = \Session::get('url.intended', $this->redirectTo);
      return $finalRedirectionTo;
    }

    //Login View Paqe -----
    public function dashboard(){
       $customerComplaint= CustomerComplaint::select('id')->count();  
      $zone= Zone::select('id')->count();  
      $user= User::select('id')->where('user_type','user')->count();  
      $vendor= User::select('id')->where('user_type','vendor')->count();  
      $driver= User::select('id')->where('user_type','driver')->count(); 
      $userthismonth = User::select('id')
            ->where('user_type','user')
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();
        $userthisweek = User::select('id')
            ->where('user_type','user')
            ->count();   
        $counterys = DB::table('country')->get();
      return view('admin.dashboard',compact('customerComplaint','zone','user','vendor','driver','userthismonth','userthisweek','counterys'));
    }   

    //Forgot Password View Paqe -----
    public function forgot_password(){
     return view('admin.login.forgot-password');
    }

      public function forgotpassword_post(Request $request)
    {
        $status = false;
        $message= '';
        $data = null;
        if ($request->get('email') != "") {
            $ckeckemailexist = User::select('email', 'name')->where('status','1')->where('user_type','!=','user')->where('email',$request->get('email'))->first();
                        //echo "<pre>"; print_r($ckeckemailexist); die();
            if ($ckeckemailexist) {
                $data = $ckeckemailexist;
                $newpassword = rand(0,100000);
                 DB::table('users')->where('email', $request->get('email'))->update(['password'=> Hash::make($newpassword),'new_pass'=> $newpassword]); 
                $check = Mail::send('emails.forgetpassword', compact('data', 'newpassword'), function ($message) use ($ckeckemailexist) {
                    $message->from('info@ibazar.com', $ckeckemailexist->name . " " . $ckeckemailexist->last_name)->subject('Your Password Has been reset');
                    $message->to($ckeckemailexist->email);
                });
                $json['success']="New password sent on your email.Please wait while we are redirecting";
                $json['redirect_url'] = URL::to('forgot-password');
                $status = true;
            } else {
                 $json['faild']="We can't find a user with that e-mail address";
                 $status = true;
            }
        } else {
             $json['email']='Please enter your email address';
             $status = true;
        }

        return json_encode($json);

    }
}