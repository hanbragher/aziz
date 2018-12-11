<?php

namespace Azizner\Http\Controllers\Admin\Users;

use Azizner\Admin;
use Azizner\Creator;
use Azizner\Notification;
use Azizner\User;
use Illuminate\Http\Request;
use Azizner\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(50);
        return view('admin.users.index', ['users'=>$users]);
    }

    public function setCreator(Request $request)
    {
        $auth_user = Auth::user();

        if(!$user = User::where('id', $request->get('id'))->first()){
            $response["status"] = "error";
            echo json_encode($response);
            exit;
        }

        if($creator = Creator::where('user_id', $user->id)->first()){
            $creator->delete();
            $user->notifications()->save(new Notification([
                'from_id'=>$auth_user->id,
                'type'=>'text',
                'type_id'=>null,
                'text'=>'Now you are not a "creator"',
            ]));
            $response["status"] = "success";
            echo json_encode($response);
            exit;
        }else{
            Creator::create(
                ['user_id' => $user->id]
            );

            $user->notifications()->save(new Notification([
                'from_id'=>$auth_user->id,
                'type'=>'text',
                'type_id'=>null,
                'text'=>'Now you are "creator"',
            ]));

            $response["status"] = "success";
            echo json_encode($response);
            exit;

        }

    }

    public function setAdmin(Request $request)
    {
        $auth_user = Auth::user();

        if(!$user = User::where('id', $request->get('id'))->first()){
            $response["status"] = "error";
            echo json_encode($response);
            exit;
        }

        if($creator = Admin::where('user_id', $user->id)->first()){
            $creator->delete();
            $user->notifications()->save(new Notification([
                'from_id'=>$auth_user->id,
                'type'=>'text',
                'type_id'=>null,
                'text'=>'Now you are not a "admin"',
            ]));

            $response["status"] = "success";
            echo json_encode($response);
            exit;
        }else{
            Admin::create(
                ['user_id' => $user->id]
            );
            $user->notifications()->save(new Notification([
                'from_id'=>$auth_user->id,
                'type'=>'text',
                'type_id'=>null,
                'text'=>'Now you are "admin"',
            ]));
            $response["status"] = "success";
            echo json_encode($response);
            exit;

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
