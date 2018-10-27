<?php

namespace Azizner\Http\Controllers\Posts;

use Azizner\Blogger;
use Azizner\Http\Controllers\ImageController;
use Azizner\Image;
use Azizner\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Azizner\Http\Controllers\Controller;
use Azizner\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware(['auth'])->only(['create', 'edit', 'store', 'update', 'destroy', 'myPosts']);
    }

    protected function validator(array $data)
    {
        $rules = [
            'title' => ['required_without:image_id', 'string', 'max:100'],
            'main_image' => [ 'image', 'mimes:jpeg,bmp,png', 'max:2048'],
            'gallery' => [ 'max:12' ],
            'gallery.*' => [ 'image', 'mimes:jpeg,bmp,png', 'max:2048'],
            'text' => ['required_without:image_id', 'string'],
            'image_id' => ['numeric'],
            'post_id' => ['numeric'],
            'destroy' => ['string', 'in:destroy'],
            'set_title' => ['string', 'in:set_title'],
            'image_title' => ['nullable', 'string', 'max:100'],
        ];

        return Validator::make($data, $rules);
    }


    public function index(Request $request)
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(2);
        return view('posts.index', ['posts'=>$posts]);
        dump($tag = Tag::where('name', $request->get('tag'))->first());
        exit;
        if($request->has('tag')) {
            $tag = Tag::where('name', $request->get('tag'))->first();
        }
        //todo nayel

        /*if(!empty($tag))


            $posts = $tag->posts()->orderBy('created_at', 'desc')->paginate(2);
        }else{
            $posts = Post::orderBy('created_at', 'desc')->paginate(2);
        }
        return view('posts.index', ['posts'=>$posts]);*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();


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

        $validator = $this->validator($request->all());
        if($validator->fails()){
            //return redirect()->back()->withErrors($validator)->withInput();
            return redirect()->back()->withErrors('Something wrong, check fields')->withInput();
        }
        $user = Auth::user();

        if(!$user->is_blogger){
            return redirect()->back()->withErrors('No permission, you should be blogger for a create new post');
        }

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
            $main_image_id = ImageController::store('blogs/'.$user->blog->id.'/'.$post->id, $request->file('main_image'));
            $post->update(['main_image'=>$main_image_id]);
        }

        if($request->hasFile('gallery')){
            $image_ids = null;
            foreach ($request->file('gallery') as $file){
                $image_ids[] = ImageController::store('blogs/'.$user->blog->id.'/'.$post->id, $file);
            }
            $post->images()->attach($image_ids);
        }

        return redirect()->route('posts.edit', $post->id)->with('message' , 'The post successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $post = Post::find($id);
        //$post = Post::all()->currentPage($id);
        return view('posts.show', ['post'=>$post]);
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
        $validator = $this->validator($request->all());
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
            //return redirect()->back()->withErrors('Something wrong, check fields')->withInput();
        }

        $user = Auth::user();
        $post = Post::find($id);

        if($user->cannot("update", $post)){
            return redirect()->back()->withErrors('khkh');
        }

        if($request->has('image_id') and $request->has('post_id')) {
            $old_image = Image::find($request->get('image_id'));
            if (empty($old_image->posts->find($id)->first())) {
                return redirect()->back()->withErrors('Permission denied');
            };

            if($request->get('destroy') == 'destroy'){
                $post->images()->detach($request->get('image_id'));
                ImageController::destroy($old_image);
                $post->update(['updated_at'=>Carbon::now()]);
                return redirect()->back()->with('message' , 'Picture has been deleted!');
            }
            if($request->get('set_title') == 'set_title'){
                $old_image->update([
                   'title'=> $request->get('image_title')
                ]);
                return redirect()->back()->with('message' , 'Picture has been updated!');
            }
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
            $post->tags()->sync($tags);
        }

        if($request->hasFile('main_image')){
            $old_main_image = Image::find($post->main_image);
            $main_image_id = ImageController::store('blogs/'.$user->blog->id.'/'.$post->id, $request->file('main_image'));
            $post->update(['main_image'=>$main_image_id]);
            ImageController::destroy($old_main_image);
        }

        if($request->hasFile('gallery')){

            $image_ids = null;
            foreach ($request->file('gallery') as $file){
                $image_ids[] = ImageController::store('blogs/'.$user->blog->id.'/'.$post->id, $file);
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
        $user = Auth::user();
        $post = Post::find($id);

        if($user->cannot("destroy", $post)){
            return redirect()->back()->withErrors('khkh');
        }

        $old_images = $post->images;
        $post->images()->detach();

        if(!empty($old_images)){
            foreach ($old_images as $image){
                ImageController::destroy($image);
            }
        }

        $post->tags()->detach();

        if($main_image_id = $post->main_image){
            $main_image = Image::find($main_image_id);
        }else{
            $main_image = null;
        }

        if(is_dir(public_path('blogs/'.$user->blog->id.'/'.$post->id))){
            File::deleteDirectory(public_path('blogs/'.$user->blog->id.'/'.$post->id));
        }

        $post->delete();
        ImageController::destroy($main_image);

        return redirect()->back()->with('message' , 'The post successfully deleted!');

    }

    public function myPosts($id = null)
    {
        return view('posts.my');
    }

}
