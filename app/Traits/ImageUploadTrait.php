<?php

namespace App\Traits;

use Illuminate\Http\Request;
use File;

trait ImageUploadTrait {
    public function uploadImage(Request $request, $inputName, $path)
    {

        if($request->hasFile($inputName)){
            
            $image = $request->{$inputName};
            // $imageName = rand().'_'.$image->getClientOriginalName(); //instead of original name you can use original extension to make the name shorter and easy to understand
            $ext = $image->getClientOriginalExtension(); 
            $imageName = 'media_'.uniqid().'.'.$ext;
            $image->move(public_path($path), $imageName);

            return $path.'/'.$imageName;
        }
    }

    public function updateImage(Request $request, $inputName, $path, $oldPath=null)
    {

        if($request->hasFile($inputName)){
            if(File::exists(public_path($oldPath))){
                File::delete(public_path($oldPath));
            }
            $image = $request->{$inputName};
            $ext = $image->getClientOriginalExtension(); 
            $imageName = 'media_'.uniqid().'.'.$ext;
            $image->move(public_path($path), $imageName);

            return $path.'/'.$imageName;
        }
    }

    /* Handle Delete File */
    public function deleteImage(string $path)
    {
        if(File::exists(public_path($path))){
            File::delete(public_path($path));
        }
    }
}