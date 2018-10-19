<?php

namespace Azizner\Http\Controllers;

use Azizner\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(Request $request){
        $user = User::find(1);
        dump($user->blog->posts->first()->images);
        dump($user->blog->posts);
        dump($user->blog->posts);

    }

}
