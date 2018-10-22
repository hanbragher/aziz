<?php

namespace Azizner\Http\Controllers\Profiles;

use Azizner\Blogger;
use Azizner\Image;
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
        return view('profile.show');
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
            $file = $request->file('avatar');
            $extension = $request->avatar->extension();
            $avatar_path = $file->move('users/'.$user->id, md5_file($file).date('YmdHisu').'.'.$extension)->getPathname();
            $avatar_image = Image::create([
                'file'=>'/'.$avatar_path
            ]);
            $user->update(['avatar_id'=>$avatar_image->id]);
            if(!empty($old_avatar)) {
                unlink(public_path($old_avatar->file));
                $old_avatar->delete();
            }
        }

        if($request->hasFile('cover')){
            $old_cover = Image::find($user->cover_id);
            $file = $request->file('cover');
            $extension = $request->cover->extension();
            $cover_path = $file->move('users/'.$user->id, md5_file($file).date('YmdHisu').'.'.$extension)->getPathname();
            $cover_image = Image::create([
                'file'=>'/'.$cover_path
            ]);
            $user->update(['cover_id'=>$cover_image->id]);
            if(!empty($old_cover)){
                unlink(public_path($old_cover->file));
                $old_cover->delete();
            }

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
                $file = $request->file('blog_cover');
                $extension = $request->blog_cover->extension();
                $blog_cover_path = $file->move('blogs/'.$user->blog->id, md5_file($file).date('YmdHisu').'.'.$extension)->getPathname();
                $blog_cover_image = Image::create([
                    'file'=>'/'.$blog_cover_path
                ]);
                $user->blog->update(['cover_id'=>$blog_cover_image->id]);
                if(!empty($old_blog_cover)){
                    unlink(public_path($old_blog_cover->file));
                    $old_blog_cover->delete();
                }
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
