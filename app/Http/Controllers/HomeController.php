<?php
namespace App\Http\Controllers;

use App\Http\Requests\{UpdatePasswordRequest,UserRequest};
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{App,Auth,Hash,Log,Session};

class HomeController extends Controller{

	/**
     * HomeController constructor.
     * @param User $user
     */
    public function __construct() {
    	//
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request){
    	return view('home');
    }

    public function profile(){
        return view('profile');
    }

    public function update(UserRequest $request){

    }

    public function changePassword(Request $request){
        $user = Auth::user();
        return view('auth/change-password',compact('user'));
    }

    public function updatePassword(UpdatePasswordRequest $request){

    }
}
