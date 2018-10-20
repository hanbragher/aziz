<?php

namespace Azizner\Http\Controllers\Posts;

use Azizner\Blogger;
use Azizner\Image;
use Azizner\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Azizner\Http\Controllers\Controller;
use Azizner\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        dump($user->b);exit;

        if(!$user->is_blogger){
            return redirect()->back()->withErrors('No permission, you should be blogger for a create new post');
        }
        $tags = Tag::all()->pluck('name');
        return view('posts.create', ['tags'=>$tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if(!$user->is_blogger){
            return redirect()->back()->withErrors('No permission, you should be blogger for a create new post');
        }

        dump($request->file('gallery'));
        dump($request->all());
        dump(!empty($obj = json_decode($request->get('tags'))));


        $post = $user->blog->posts()->save( new Post([
            "title"=>$request->get('title'),
            "text"=>$request->get('text'),
        ]));

        if(!empty($obj = json_decode($request->get('tags')))){
            $tags = null;
            foreach ($obj as $item)
            {
                $tag = Tag::firstOrCreate(['name'=>$item->tag]);
                $tags[] = $tag->id;
            }
            $post->tags()->attach($tags);
        }

        if($request->hasFile('main_image')){
            $file = $request->file('main_image');
            $extension = $request->main_image->extension();
            $main_image_path = $file->move('images/post/'.$post->id, md5_file($file).'.'.$extension)->getPathname();
            $main_image = Image::create([
                'file'=>'/'.$main_image_path
            ]);
            $post->update(['main_image'=>$main_image->id]);
        }

        if($request->hasFile('gallery')){
            $image_ids = null;
            foreach ($request->file('gallery') as $file){
                $extension = $file->extension();
                $gallery_image_path = $file->move('images/post/'.$post->id, md5_file($file).'.'.$extension)->getPathname();
                $image = Image::create([
                    'file'=>'/'.$gallery_image_path
                ]);
                $image_ids[] = $image->id;
            }
            $post->images()->attach($image_ids);
        }

        exit;
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
        $post = Post::find($id);
        $user = Auth::user();

        if($user->cannot("edit", $post)){
            return redirect()->back()->withErrors('No permission, you should be blogger for edit your own post');
        }

        $tags = Tag::all()->pluck('name');
        return view('posts.edit', ['post'=>$post, 'tags'=>$tags]);
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
        $post = Post::find($id);

        if($user->cannot("update", $post)){
            return redirect()->back()->withErrors('khkh');
        }

        if($request->has('image_id') and $request->has('post_id')) {
            $image = Image::find($request->get('image_id'));
            if (empty($image->posts->find($id)->first())) {
                return redirect()->back()->withErrors('khkh');
            };
            $post->images()->detach($request->get('image_id'));
            $post->update(['updated_at'=>Carbon::now()]);
            return redirect()->back()->with('message' , 'Picture has been deleted!');
        }

        $post->update([
            "title"=>$request->get('title'),
            "text"=>$request->get('text'),
            'updated_at'=>Carbon::now()
        ]);

        if(!empty($obj = json_decode($request->get('tags')))){
            $tags = null;
            foreach ($obj as $item)
            {
                $tag = Tag::firstOrCreate(['name'=>$item->tag]);
                $tags[] = $tag->id;
            }
            $post->tags()->attach($tags);
        }

        if($request->hasFile('main_image')){
            $file = $request->file('main_image');
            $extension = $request->main_image->extension();
            $main_image_path = $file->move('images/post/'.$post->id, md5_file($file).'.'.$extension)->getPathname();
            $main_image = Image::create([
                'file'=>'/'.$main_image_path
            ]);
            $post->update(['main_image'=>$main_image->id]);
        }

        if($request->hasFile('gallery')){
            $image_ids = null;
            foreach ($request->file('gallery') as $file){
                $extension = $file->extension();
                $gallery_image_path = $file->move('images/post/'.$post->id, md5_file($file).'.'.$extension)->getPathname();
                $image = Image::create([
                    'file'=>'/'.$gallery_image_path
                ]);
                $image_ids[] = $image->id;
            }
            $post->images()->attach($image_ids);
        }

        return redirect()->back()->with('message' , 'The post successfully updated!');

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

    public function myPosts($id = null)
    {

        return view('posts.my');
    }

}
