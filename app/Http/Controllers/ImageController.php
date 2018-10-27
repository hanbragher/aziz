<?php

namespace Azizner\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Azizner\Image;

class ImageController extends Controller
{
    static function store($folder, $file, $thumb = true){
        $extension = $file->extension();
        $image = md5($file).Carbon::now()->timestamp.'.'.$extension;
        $image_path = $file->move($folder, $image)->getPathname();

        \Intervention\Image\Facades\Image::make($image_path)
            ->encode($extension)
            ->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->save($image_path);

        if($thumb === true){
            $thumb_save_to_path = $folder.'/thumb'.$image;
            \Intervention\Image\Facades\Image::make($image_path)
                ->fit(300, 300)
                ->save($thumb_save_to_path);
            $thumb_path = '/'.$thumb_save_to_path;
        }else{
            $thumb_path = null;
        }

        return Image::create([
            'file'=>'/'.$image_path,
            'thumb'=> $thumb_path
        ])->id;
    }

    static function secureStore($folder, $file, $thumb = true){
        $extension = $file->extension();
        $image = md5($file).Carbon::now()->timestamp.'.'.$extension;
        $image_path = $file->move($folder, $image)->getPathname();

        \Intervention\Image\Facades\Image::make($image_path)
            ->encode($extension)
            ->resize(null, 1000, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->save($image_path);

        if($thumb === true){
            $thumb_save_to_path = $folder.'/thumb'.$image;
            \Intervention\Image\Facades\Image::make($image_path)
                ->fit(300, 300)
                ->save($thumb_save_to_path);
            $thumb_path = '/'.$thumb_save_to_path;
        }else{
            $thumb_path = null;
        }

        return Image::create([
            'file'=>'/'.$image_path,
            'thumb'=> $thumb_path
        ])->id;
    }

    static function destroy($old_image_object){
        if(!empty($old_image_object)){
            if(is_file(public_path($old_image_object->file))){unlink(public_path($old_image_object->file));};
            if(is_file(public_path($old_image_object->thumb))){unlink(public_path($old_image_object->thumb));};
            $old_image_object->delete();
        }
        return true;
    }

    static function destroyFromSecure($old_image_object){
        if(!empty($old_image_object)){
            if(is_file(public_path($old_image_object->file))){unlink(public_path($old_image_object->file));};
            if(is_file(public_path($old_image_object->thumb))){unlink(public_path($old_image_object->thumb));};
            $old_image_object->delete();
        }
        return true;
    }
}
