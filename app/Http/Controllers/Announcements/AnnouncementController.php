<?php

namespace Azizner\Http\Controllers\Announcements;

use Azizner\Announcement;
use Illuminate\Http\Request;
use Azizner\Http\Controllers\Controller;
use Azizner\Tag;

use Azizner\Blogger;
use Azizner\Http\Controllers\ImageController;
use Azizner\Image;
use Azizner\Post;
use Azizner\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware(['auth'])->only(['create', 'edit', 'store', 'update', 'destroy', 'myAnnouncements']);
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
        if($request->has('tag')) {
            if(empty($tag = Tag::where('name', 'like', '%'.$request->get('tag').'%')->first()))
            {
                return redirect()->route('announcements.index')->withErrors('No results');
            }
            $announcements = $tag->announcements()->paginate(3);
        }else{
            $announcements = Announcement::orderBy('created_at', 'desc')->paginate(3);
        }
            return view('announcements.index', ['announcements'=>$announcements]);
    }

    public function myAnnouncements()
    {
        $user = Auth::user();
        $announcements = $user->announcements()->paginate(2);
        return view('announcements.my', ['announcements'=>$announcements]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $announcement = Announcement::findOrFail($id);
        //$post = Post::all()->currentPage($id);
        return view('announcements.show', ['announcement'=>$announcement]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all()->pluck('name');
        return view('announcements.create', ['tags'=>$tags]);
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

        $announcement = $user->announcements()->save( new Announcement([
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
            $announcement->tags()->attach($tags);
        }

        if($request->hasFile('main_image')){
            $main_image_id = ImageController::store('images/announcements/'.$user->id.'/'.$announcement->id, $request->file('main_image'), $thumb = [true, 190, 190]);
            $announcement->update(['main_image'=>$main_image_id]);
        }

        if($request->hasFile('gallery')){
            $image_ids = null;
            foreach ($request->file('gallery') as $file){
                $image_ids[] = ImageController::store('images/announcements/'.$user->id.'/'.$announcement->id, $file);
            }
            $announcement->images()->attach($image_ids);
        }

        return redirect()->route('announcements.edit', $announcement->id)->with('message' , 'The post successfully created!');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        $user = Auth::user();
        if($user->cannot("edit", $announcement)){
            return redirect()->back()->withErrors('No permission');
        }
        $tags = Tag::all()->pluck('name');
        return view('announcements.edit', ['announcement'=>$announcement, 'tags'=>$tags]);
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
        $announcement = Announcement::findOrFail($id);

        if($user->cannot("update", $announcement)){
            return redirect()->back()->withErrors('Permission denied');
        }

        if($request->has('image_id') and $request->has('announcement_id')) {
            if(empty($old_image = Image::find($request->get('image_id')))){
                return redirect()->back()->withErrors('Permission denied');
            };

            if (empty($old_image->announcements->find($id)->first())) {
                return redirect()->back()->withErrors('Permission denied');
            };

            if($request->get('destroy') == 'destroy'){
                $announcement->images()->detach($request->get('image_id'));
                ImageController::destroy($old_image);
                $announcement->update(['updated_at'=>Carbon::now()]);
                return redirect()->back()->with('message' , 'Picture has been deleted!');
            }
            if($request->get('set_title') == 'set_title'){
                $old_image->update([
                    'title'=> $request->get('image_title')
                ]);
                return redirect()->back()->with('message' , 'Title has been updated!');
            }
            return redirect()->back()->withErrors('Permission denied');
        }

        $announcement->update([
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
            $announcement->tags()->sync($tags);
        }else{
        $announcement->tags()->detach();
    }



        if($request->hasFile('main_image')){
            $old_main_image = Image::find($announcement->main_image);
            $main_image_id = ImageController::store('images/announcements/'.$user->id.'/'.$announcement->id, $request->file('main_image'), $thumb = [true, 190, 190]);
            $announcement->update(['main_image'=>$main_image_id]);
            ImageController::destroy($old_main_image);
        }

        if($request->hasFile('gallery')){
            $can_upload = 12-$announcement->images->count();
            $uploaded = count($request->file('gallery'));
            if($can_upload <= $uploaded-1){
                return redirect()->back()->withErrors('Total count images of gallery should not be more 12 psc.')->withInput();
            }
            $image_ids = null;
            foreach ($request->file('gallery') as $file){
                $image_ids[] = ImageController::store('images/announcements/'.$user->id.'/'.$announcement->id, $file);
            }
            $announcement->images()->attach($image_ids);
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
        $announcement = Announcement::findOrFail($id);

        if($user->cannot("destroy", $announcement)){
            return redirect()->back()->withErrors('no permission');
        }

        $old_images = $announcement->images;
        $announcement->images()->detach();

        if(!empty($old_images)){
            foreach ($old_images as $image){
                ImageController::destroy($image);
            }
        }

        $announcement->tags()->detach();

        if($main_image_id = $announcement->main_image){
            $main_image = Image::find($main_image_id);
        }else{
            $main_image = null;
        }

        if(is_dir(public_path('images/announcements/'.$user->id.'/'.$announcement->id))){
            File::deleteDirectory(public_path('images/blogs/'.$user->id.'/'.$announcement->id));
        }

        $announcement->delete();
        ImageController::destroy($main_image);

        return redirect()->back()->with('message' , 'The announcement successfully deleted!');
    }
}
