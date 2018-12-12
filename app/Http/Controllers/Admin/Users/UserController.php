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
    public function index(Request $request)
    {

        $id = '%';
        $email = '%';
        $search_type = null;
        $search = null;

        if($request->has('search_type')){
            $search_type = $request->get('search_type');
            if(!empty($request->get('search'))){
                $search = $request->get('search');
                if($search_type == 'id' ){
                    $id = $request->get('search');
                }elseif($search_type == 'email'){
                    $email = $request->get('search');
                }
            }
        }

        if(empty($request->all()) or $request->has('search') or $request->has('all')){
            $users = User::where('id', 'like', $id)->where('email', 'like', '%'.$email.'%');
            $active_bar = 'all';
        }elseif ($request->has('admins')){
            $users = Admin::where('id', 'like', $id);
            $active_bar = 'admins';
        }elseif ($request->has('creators')){
            $users = Creator::where('id', 'like', $id);
            $active_bar = 'creators';
        }


        return view('admin.users.index', ['users'=>$users->paginate(50), 'active_bar'=>$active_bar, 'search'=>$search, 'search_type'=>$search_type]);
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
