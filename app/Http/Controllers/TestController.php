<?php

namespace Azizner\Http\Controllers;

use Azizner\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
//use Intervention\Image\Facades\Image;
use Azizner\Image;
use Illuminate\Support\Facades\App;
use ZipArchive;
use Azizner\Announcement;



class TestController extends Controller
{
    public function test(Request $request){
        $user = User::find(1);
        /*dump($user->blog);
        dump($user->adverts);
        dump($user->favoriteAnnouncements);*/

        /*$user->favoriteAnnouncements()->attach(1);*/
        dump(route('favorites.store'));

        dump($user->favoriteAnnouncements->contains(3));
        dump($announcement = Announcement::where('id',50)->first());




        exit;

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


       /* if(empty($old_image = Image::find(10))){
            echo 1;
        }
        dump(empty($old_image)); exit;

        //ImageController::secureStore(storage_path('app/images'), 'images/card.jpg'); exit;

        //if(is_file('/blogs/1/54\a695373814a0fc78a7277ef9669bd2621540554756.jpeg')){unlink(public_path('/blogs/1/54\a695373814a0fc78a7277ef9669bd2621540554756.jpeg'));};



        dump(Carbon::now()->year);
        $user = User::find(1);
        dump($user->blog->posts->first()->images);
        dump($user->blog->posts);
        dump(Carbon::now());
        dump(Carbon::now()->timestamp);*/


    }

}
