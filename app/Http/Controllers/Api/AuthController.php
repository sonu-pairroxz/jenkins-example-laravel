<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Mail\ForgotPassword;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\{
    Carbon,
    Facades\Hash,
    Facades\Log,
    Facades\Mail,
    Facades\Session,
    Facades\Validator,
    Str
};
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(Request $request): Response
    {
        try {
            $validator = Validator::make($request->all(), [
                'email'=> 'required|email|exists:users,email',
                'password'=>'required|min:6',
            ]);
            if($validator->fails()){
                return ResponseBuilder::error($validator->errors()->first(),$this->validationStatus);
            }

            $user = User::where('email',$request->email)->first();
            if(!$user){
                return ResponseBuilder::error("User Not Authorised",$this->validationStatus);
            }
            if($user->status == 'Inactive'){
                return ResponseBuilder::error("User not activated",$this->validationStatus);
            }

            $credentials = $request->only(['email','password']);
            if(!auth()->attempt($credentials)){
                return ResponseBuilder::error("Invalid Credential",$this->validationStatus);
            }

            $user = $request->user();
            $token = $user->createToken(config('app.name'),['app'])->accessToken;

            $this->response->user = new UserResource($user);

            return ResponseBuilder::successWithToken($token,$this->response);

        }catch (Exception $e){
            Log::error($e);
            return ResponseBuilder::error(__('api.default_error_message'), $this->errorStatus);
        }
    }

    public function register(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'first_name'    => 'required|max:20',
                'last_name'     => 'required|max:20',
                'email'         => 'required|max:50|email|unique:users,email',
                'mobile_no'     => 'required|max:12|unique:users,mobile_no',
                'password'      => ['required',Password::min(8)],
            ]);
            if($validator->fails()){
                return ResponseBuilder::error($validator->errors()->first(),$this->validationStatus);
            }
            $input = $request->only(['first_name','last_name','email','mobile_no']);
            $input['password'] = Hash::make($request->password);
            $user = User::create($input);

            $token = $user->createToken(config('app.name'),['app'])->accessToken;
            $this->response->user = new UserResource($user);

            return ResponseBuilder::successWithToken($token,$this->response);
        }catch (Exception $e){
            Log::error($e);
            return ResponseBuilder::error(__('api.default_error_message'), $this->errorStatus);
        }
    }
    /**
     * @param Request $request
     * @return Response
     */
    public function logout(Request $request): Response
    {
        /*if (!empty($request->header('device-id'))) {
            $request->user()->devices()
                ->where('device_id', $request->header('device-id'))
                ->delete();
        }*/
        $request->user('api')->token()->revoke();
        return ResponseBuilder::success(null, __('api.logout_success'));
    }
    /**
     * @param Request $request
     * @return Response
     */
    public function forgotPassword(Request $request): Response
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
            ]);

            if ($validator->fails()) {
                return ResponseBuilder::error($validator->errors()->first(), $this->validationStatus);
            }

            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return ResponseBuilder::error(__('api.not_found'), $this->validationStatus);
            }

            $token = (Str::random(36));
            $user->token = $token;
            $user->token_created_at = now();
            $user->save();

            Mail::to($user->email)->queue(new ForgotPassword($user));

            return ResponseBuilder::success(null, __('EMail Sent.'));
        } catch (Exception $e) {
            Log::error($e);
            return ResponseBuilder::error(__('api.default_error_message'), $this->errorStatus);
        }
    }


    public function resetPassword(Request $request) {
        $title = 'Reset Password';

        $user = User::where('token', $request->token)->first();
        if (!$user) {
            $error = __('admin.token_invalid');
            return view('reset-password', compact('title', 'error'));
        }

        if (Carbon::parse($user->token_created_at)->diffInSeconds(now()) > 300) {
            $error = __('admin.token_expired');
            return view('reset-password', compact('title', 'error'));
        }

        $token = $request->token;
        return view('reset-password', compact('title', 'token'));
    }


    public function resetPasswordPost(Request $request) {
        try {
            $title = 'Reset Password';
            $validator = Validator::make($request->all(), [
                'password' => ['required', 'string', 'min:8'],
                'confirm_password' => ['required', 'same:password']
            ]);
            if ($validator->fails()) {
                return back()->withInput()->withErrors($validator);
            }

            $user = User::where('token', $request->token)->first();
            if (!$user) {
                $error = "Invalid Token.";
                session::flash("error", $error);
                return redirect(route('users.reset_password',$request->token));
            }

            if (Carbon::parse($user->token_created_at)->diffInSeconds(now()) > 300) {
                $error = "Token Expired. Try Again!";
                session::flash("error", $error);
                return redirect(route('users.reset_password',$request->token));
            }

            $user->password = Hash::make($request->password);
            $user->token = $user->token_created_at = null;
            $user->save();

            $success =  "Password changed successfully";
            session::flash("success", $success);
            return redirect(route('users.reset_password',$request->token));
        } catch (Exception $e) {
            Log::error($e);
            return back()->with('error', __('admin.default_error_message'))->withInput($request->all());
        }
    }
    public function profile(Request $request){
        try {
            $user = $request->user('api');
            $this->response->user = new UserResource($user);
            return ResponseBuilder::success($this->response,'',$this->successStatus);
        }catch (Exception $e){
            Log::error($e);
            return ResponseBuilder::error(__('api.default_error_message'), $this->errorStatus);
        }
    }
}
