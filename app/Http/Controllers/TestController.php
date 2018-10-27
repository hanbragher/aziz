<?php

namespace Azizner\Http\Controllers;

use Azizner\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;



class TestController extends Controller
{
    public function test(Request $request){

        //ImageController::secureStore(storage_path('app/images'), 'images/card.jpg'); exit;

        //if(is_file('/blogs/1/54\a695373814a0fc78a7277ef9669bd2621540554756.jpeg')){unlink(public_path('/blogs/1/54\a695373814a0fc78a7277ef9669bd2621540554756.jpeg'));};



        dump(Carbon::now()->year);
        $user = User::find(1);
        dump($user->blog->posts->first()->images);
        dump($user->blog->posts);
        dump(Carbon::now());
        dump(Carbon::now()->timestamp);


    }

}
