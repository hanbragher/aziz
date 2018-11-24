<?php

namespace Azizner\Http\Controllers;

use Azizner\Photo;
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
        $frame = '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d30485.109598527943!2d44.891109!3d40.801673!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x293121c72328670b!2z0JzQvtC90LDRgdGC0YvRgNGMINCQ0LPQsNGA0YbQuNC9!5e1!3m2!1sru!2sus!4v1543063453066" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>';

        dump(str_contains($frame,'www.google.com/maps/embed'));

        if(!str_contains($frame,'hjkfghk') and !str_contains($frame,'www.google.com/maps/embed')){
            dump(1);
        }

        $array = ['width="400"', 'width="600"', 'width="800"', ];
        dump(str_replace($array,'width="100%"', $frame));


        exit;
        $user = User::find(1);
        $photo = Photo::find(8);
        dump($photo->stars->count());
        /*dump($user->blog);
        dump($user->adverts);
        dump($user->favoriteAnnouncements);*/

        /*$user->favoriteAnnouncements()->attach(1);*/
        dump(route('favorites.store'));

        dump($user->favoritePhotos->contains(3));
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
