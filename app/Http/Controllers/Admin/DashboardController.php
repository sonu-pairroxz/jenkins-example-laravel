<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Log;

/**
 *
 */
class DashboardController extends Controller
{
    function __construct(User $user){
        $this->user = $user;

    }
	public function index(){
        try {
            //$start_week = strtotime("last sunday midnight",strtotime("-1 week +1 day"));
            //$end_week = strtotime("next saturday",$start_week);
            //Users Count
            $total_users = $this->user->where('role','!=','admin')->count();

            return view('admin.dashboard', compact('total_users'));
        }catch (\Exception $e){
            Log::error($e);
            return abort(500);
        }
    }
}
