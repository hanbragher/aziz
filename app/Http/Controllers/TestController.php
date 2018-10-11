<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(Request $request){
        dump($request->all());
        dump($request->json()->all());

    }

}
