<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseBuilder;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request){
        try {
            return ResponseBuilder::success($this->response, null ,$this->successStatus);
        }catch (Exception $e){
            Log::error($e);
            return ResponseBuilder::error(__('api.default_error_message'), $this->errorStatus);
        }
    }

    public function total(Request $request){
        try {
            $carts = $request->user('api')->carts;
            $wishlists = $request->user('api')->wishlist;
            $this->response->cart_total = $carts->count();
            $this->response->wishlist_total = $wishlists->count();
            return ResponseBuilder::success($this->response, null ,$this->successStatus);
        }catch (Exception $e){
            Log::error($e);
            return ResponseBuilder::error(__('api.default_error_message'), $this->errorStatus);
        }
    }

    public function trendings(Request $request){
        try {
            $trending_products = Product::query()->withCount(['orderItems' => function($query){
                $query->whereMonth('order_items.created_at', Carbon::now()->month);
            }])->with(['wishlist' => function($q){
                $q->where('user_id', auth('api')->user()->id);
            }])->having('order_items_count','>',0)->orderBy('order_items_count','DESC')->paginate(16);
            $this->response->products = ProductShortResource::collection($trending_products);
            return ResponseBuilder::successWithPagination($trending_products,$this->response, null ,$this->successStatus);
        }catch (Exception $e){
            Log::error($e);
            return ResponseBuilder::error(__('api.default_error_message'), $this->errorStatus);
        }
    }
}
