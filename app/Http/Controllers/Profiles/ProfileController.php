<?php

namespace Azizner\Http\Controllers\Profiles;

use Azizner\Admin;
use Azizner\Blogger;
use Azizner\Http\Controllers\ImageController;
use Azizner\Image;
use Azizner\User;
use Illuminate\Http\Request;
use Azizner\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware(['auth']);
    }

    protected function validator(array $data)
    {
        $rules = [
            'password' => ['nullable'],
            'password_confirmation' => [ 'required_with:password', 'same:password'],
        ];

        return Validator::make($data, $rules);
    }


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

    public function profilePosts($id)
    {
        $show_user = User::findOrFail($id);
        return view('profile.posts', ['show_user'=>$show_user]);
    }

    public function profileNotes($id)
    {
        $show_user = User::findOrFail($id);
        return view('profile.notes', ['show_user'=>$show_user]);
    }

    public function profileAnnouncements($id)
    {
        $show_user = User::findOrFail($id);
        return view('profile.announcements', ['show_user'=>$show_user]);
    }

    public function profilePhotos($id)
    {
        $show_user = User::findOrFail($id);
        return view('profile.photos', ['show_user'=>$show_user]);
    }

    public function myPage()
    {
        return view('profile.my', ['active'=>'overview']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pick_user = Auth::user();

        if(Admin::where('user_id', $pick_user->id)->first()){
            $pick_user = User::findOrFail($id);
        }

        return view('profile.edit', ['pick_user'=>$pick_user]);
    }

    public function changePassword($id)
    {
        $pick_user = Auth::user();

        if(Admin::where('user_id', $pick_user->id)->first()){
            $pick_user = User::findOrFail($id);
        }

        return view('profile.change_password', ['pick_user'=>$pick_user]);
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
        $validator = $this->validator($request->all());
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
            //return redirect()->back()->withErrors('Something wrong, check fields')->withInput();
        };

        $user = Auth::user();

        if(!$user->isAdmin()){
            if($user->id != $id){
                return redirect()->back()->withErrors('No permission');
            }
        }else{
            $user = User::findOrFail($id);
        }




        if($request->has('old_password') and $request->has('password')){
            if(empty($request->get('password'))){
                return redirect()->back()->withErrors('Password can not be empty.');
            }
            if(Hash::check($request->get('old_password'), $user->getAuthPassword())){
                $user->update([
                   'password'=> Hash::make($request->get('password')),
                ]);
                return redirect()->route('profiles.edit', $user->id)->with('message' , 'The new password saved.');
            };
            return redirect()->back()->withErrors('Current password is incorrect.');
        }


        $user->update([
            'first_name'=>$request->get('first_name'),
            'last_name'=>$request->get('last_name'),
        ]);

        if($request->hasFile('avatar')){
            $old_avatar = Image::find($user->avatar_id);
            $avatar_id = ImageController::store('images/users/'.$user->id, $request->file('avatar'), [true, 1000, 1000]);
            $user->update(['avatar_id'=>$avatar_id]);
            ImageController::destroy($old_avatar);
        }

        if($request->hasFile('cover')){
            $old_cover = Image::find($user->cover_id);
            $cover_id = ImageController::store('images/users/'.$user->id, $request->file('cover'), false);
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
