<?php

namespace Azizner\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Azizner\Image;
use Illuminate\Support\Facades\Auth;
use ZipArchive;


class ImageController extends Controller
{

    public function __construct() {
        $this->middleware(['auth']);
    }

    static function store($folder, $file, $thumb = [true, 300, 300], $secure = false, $resize = true){
        if($secure === true){
            $folder = 'secure/'.$folder;
        }

        $extension = $file->extension();
        $image = md5($file).Carbon::now()->timestamp.'.'.$extension;
        $image_path = $file->move($folder, $image)->getPathname();

        if($resize === true){
            \Intervention\Image\Facades\Image::make($image_path)
                ->encode($extension)
                ->resize(null, 1000, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save($image_path);
        }

        if($thumb[0] === true){
            $thumb_save_to_path = $folder.'/thumb'.$image;
            \Intervention\Image\Facades\Image::make($image_path)
                ->fit($thumb[1], $thumb[2])
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


    public function downloadFromSecure(Request $request)
    {
        $user = Auth::user();



        $public_dir = public_path('/folder/temp');

        $zipFileName = 'myZip.zip';

        $zip = new ZipArchive;

        $file_path = public_path('/folder/test.jpg');

        if ($zip->open($public_dir . '/' . $zipFileName, ZipArchive::CREATE) === TRUE) {
            // Add File in ZipArchive
            $zip->addFile($file_path,'image.jpg');
            // Close ZipArchive
            $zip->close();
        }
        $headers = array(
            'Content-Type' => 'application/octet-stream',
        );

        $filetopath=$public_dir.'/'.$zipFileName;
        // Create Download Response

        if(file_exists($filetopath)) {
            return response()->download($filetopath, $zipFileName, $headers)->deleteFileAfterSend(true);
        }

    }
}
