<?php

namespace Azizner\Http\Controllers;

use Azizner\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(Request $request){
        dump(Carbon::now()->year);
        $user = User::find(1);
        dump($user->blog->posts->first()->images);
        dump($user->blog->posts);
        dump(Carbon::now());
        dump(Carbon::now()->timestamp);


    }

}
