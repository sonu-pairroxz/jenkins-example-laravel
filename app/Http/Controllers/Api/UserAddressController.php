<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseBuilder;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserAddressResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Log,Validator};

class UserAddressController extends Controller
{
    public function index(Request $request){
        try {
            $addresses = $request->user('api')->address()->latest()->get();
            $this->response->address = UserAddressResource::collection($addresses);
            return ResponseBuilder::success($this->response, null ,$this->successStatus);

        }catch (\Exception $e){
            Log::error($e);
            return ResponseBuilder::error('api.default_error_message',$this->errorStatus);
        }
    }

    public function store(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'first_name'    => 'required|max:20',
                'last_name'     => 'required|max:20',
                'email'         => 'required|email|max:50',
                'mobile_no'     => 'required|min:8|max:13',
                'address'       => 'required|max:100',
                'city'          => 'required|max:20',
                'state'         => 'required|max:20',
                'country'       => 'required|max:20',
                'zipcode'       => 'required|max:10',
            ]);
            if($validator->fails()){
                return ResponseBuilder::error($validator->errors()->first(),$this->validationStatus);
            }

            $user = $request->user('api');
            $input = $request->only(["first_name","last_name","email","mobile_no","address","city","state","country","zipcode"]);

            $address = $user->address()->create($input);

            $addresses = $request->user('api')->address()->latest()->get();
            $this->response->address = UserAddressResource::collection($addresses);
            return ResponseBuilder::success($this->response, null ,$this->successStatus);
        }catch (\Exception $e){
            Log::error($e);
            return ResponseBuilder::error('api.default_error_message',$this->errorStatus);
        }
    }

    public function update(Request $request, $id){
        try {
            $validator = Validator::make($request->all(), [
                'first_name'    => 'required|max:20',
                'last_name'     => 'required|max:20',
                'email'         => 'required|email|max:50',
                'mobile_no'     => 'required|min:8|max:13',
                'address'       => 'required|max:100',
                'city'          => 'required|max:20',
                'state'         => 'required|max:20',
                'country'       => 'required|max:20',
                'zipcode'       => 'required|max:10',
            ]);
            if($validator->fails()){
                return ResponseBuilder::error($validator->errors()->first(),$this->validationStatus);
            }
            $address = $request->user('api')->address()->where('id',$id)->first();
            if (!$address){
                return ResponseBuilder::error("Address not found", $this->notFoundStatus);
            }
            $input = $request->only(["first_name","last_name","email","mobile_no","address","city","state","country","zipcode"]);
            $address->update($input);

            $addresses = $request->user('api')->address()->latest()->get();
            $this->response->address = UserAddressResource::collection($addresses);
            return ResponseBuilder::success($this->response, "Address updated successfully" ,$this->successStatus);
        }catch (\Exception $e){
            Log::error($e);
            return ResponseBuilder::error('api.default_error_message',$this->errorStatus);
        }
    }

    public function delete(Request $request, $id){
        try {
            $address = $request->user('api')->address()->where('id',$id)->first();
            if (!$address){
                return ResponseBuilder::error("Address not found", $this->notFoundStatus);
            }
            $address->delete();

            $addresses = $request->user('api')->address()->latest()->get();
            $this->response->address = UserAddressResource::collection($addresses);
            return ResponseBuilder::success($this->response, "Address removed successfully" ,$this->successStatus);
        }catch (\Exception $e){
            Log::error($e);
            return ResponseBuilder::error('api.default_error_message',$this->errorStatus);
        }
    }
}
