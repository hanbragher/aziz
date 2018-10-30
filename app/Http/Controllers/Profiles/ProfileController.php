<?php

namespace Azizner\Http\Controllers\Profiles;

use Azizner\Blogger;
use Azizner\Http\Controllers\ImageController;
use Azizner\Image;
use Azizner\User;
use Illuminate\Http\Request;
use Azizner\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $show_user = User::findOrFail($id);
        return view('profile.show', ['show_user'=>$show_user]);
    }



    public function profileNotes($id)
    {
        $show_user = User::findOrFail($id);
        return view('profile.show', ['show_user'=>$show_user]);
    }

    public function profileAdverts($id)
    {
        $show_user = User::findOrFail($id);
        return view('profile.show', ['show_user'=>$show_user]);
    }

    public function myPage()
    {
        return view('profile.my');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();

        return view('profile.edit');
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
        $user = Auth::user();
        //dump($request->all());exit;
        //dump($request->hasFile('avatar'));exit;

        if($user->id != $id){
            dump('olala');
        }

        $user->update([
            'first_name'=>$request->get('first_name'),
            'last_name'=>$request->get('last_name'),
        ]);



        if($request->hasFile('avatar')){
            $old_avatar = Image::find($user->avatar_id);
            $avatar_id = ImageController::store('users/'.$user->id, $request->file('avatar'));
            $user->update(['avatar_id'=>$avatar_id]);
            ImageController::destroy($old_avatar);
        }

        if($request->hasFile('cover')){
            $old_cover = Image::find($user->cover_id);
            $cover_id = ImageController::store('users/'.$user->id, $request->file('cover'), false);
            $user->update(['cover_id'=>$cover_id]);
            ImageController::destroy($old_cover);
        }


        if($request->get('is_blogger') and $request->get('is_blogger') == 'on'){
            $blogger = Blogger::firstOrCreate(['user_id'=>$user->id]);
            $user->update([
                'is_blogger' => true,
            ]);

            if($request->get('blog_name')){
                $user->blog->update([
                    'name' => $request->get('blog_name')
                ]);
            }

            if($request->get('description')){
                $user->blog->update([
                    'description' => $request->get('description')
                ]);
            }

            if($request->hasFile('blog_cover')){
                $old_blog_cover = Image::find($user->blog->cover_id);
                $blog_cover_id = ImageController::store('blogs/'.$user->blog->id, $request->file('blog_cover'), false);
                $user->blog->update(['cover_id'=>$blog_cover_id]);
                ImageController::destroy($old_blog_cover);
            }
        }else{
            $user->update([
                'is_blogger' => false,
            ]);
        }
        return redirect()->back()->with('message' , 'The profile settings successfully saved!');


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
