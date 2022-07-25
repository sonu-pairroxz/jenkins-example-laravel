<?php 

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait ImageTrait
{
    
    public function hasImage($imageName) {
        //return (Storage::disk('public')->exists($imageName) ? asset('storage/app/public') . "/" . $imageName : asset('storage/app/public') . "/404.jpeg");
        return $imageName;
    }
    public function fileUpload($files, $is_array = false,$folder_name=null) {
		if ($is_array) {
			$response = [];
			foreach ($files as $file) {

				$imageName = time() . rand(1, 99) . '.' . $file->getClientOriginalExtension();
				if (!file_exists(storage_path('app/public/'.$folder_name.'/'))) {
				 mkdir(storage_path('app/public/'.$folder_name.'/'), 0777, true);
				}
				$file->storeAs('public/', $imageName);
				Image::make($file)/*->resize(300, 200)*/->save(storage_path('app/public/'.$folder_name.'/' . $imageName));
				$imageName = $folder_name.'/'.$imageName;
				//return $imageName;
				$response[] = ['name' => $imageName];
			}
			//echo "<pre>"; print_r($response); die();
			return $response;
		} else {
			$imageName = time() . rand(1, 99) . '.' . $files->getClientOriginalExtension();
			if (!file_exists(storage_path('app/public/'.$folder_name.'/'))) {
			 mkdir(storage_path('app/public/'.$folder_name.'/'), 0777, true);
			}
			$files->storeAs('public/', $imageName);
			Image::make($files)/*->resize(300, 200)*/->save(storage_path('app/public/'.$folder_name.'/' . $imageName));
			 $imageName = $folder_name.'/'.$imageName;
			return $imageName;
		}
	}
}
