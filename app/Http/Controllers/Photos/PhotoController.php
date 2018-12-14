<?php

namespace Azizner\Http\Controllers\Photos;

use Azizner\Http\Controllers\ImageController;
use Azizner\Image;
use Azizner\Photo;
use Azizner\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Azizner\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct() {
        $this->middleware(['auth'])->only(['create', 'edit', 'store', 'update', 'destroy', 'myPhotos']);
    }

    protected function validator(array $data, $update = false)
    {
        $rules = [
            'title' => ['nullable', 'string', 'max:100'],
            'photo' => [ (($update)?'nullable':'required'), 'image', 'mimes:jpeg,bmp,png', 'max:4096'],
        ];

        return Validator::make($data, $rules);
    }


    public function myPhotos()
    {
        $user = Auth::user();
        $photos = $user->photos()->paginate(2);
        return view('photos.my', ['active_menu'=>'myphotos', 'photos'=>$photos]);
    }

    public function comments($id)
    {
        $photo = Photo::findOrFail($id);
        $user = Auth::user();

        if($user->cannot("showComments", $photo)){
            return redirect()->back()->withErrors('No permission');
        }
        $comments = $photo->comments()->orderBy('created_at', 'desc')->get();

        $photo->comments()->update(['is_read'=> true]);

        return view('photos.comments', ['active_menu'=>'myphotos', 'comments'=>$comments, 'photo'=>$photo]);

    }


    public function index(Request $request)
    {
        if($request->has('tag')){
            if(empty($tag = Tag::where('name', $request->get('tag'))->first()))
            {
                return redirect()->route('photos.index')->withErrors('No results');
            }else{
                $photos = $tag->photos()->orderBy('created_at', 'desc')->paginate(3);
            }
        }else{
            $photos = Photo::orderBy('created_at', 'desc')->paginate(3);
        }

        return view('photos.index', ['photos'=>$photos, 'active_menu'=>'photos']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all()->pluck('name');
        return view('photos.create', ['active_menu'=>'newphoto', 'tags'=>$tags]);
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

        $photo_id = ImageController::store('images/photos/'.$user->id, $request->file('photo'));

        $photo = $user->photos()->save( new Photo([
            "image_id"=>$photo_id
        ]));

        if($request->has('title')){
            Image::find($photo_id)->update([
                'title'=> $request->get('title')
            ]);
        }

        if(!empty($obj = json_decode($request->get('tags')))){
            $tags = null;
            foreach ($obj as $item)
            {
                $tag = Tag::firstOrCreate(['name'=>$item->tag]);
                $tags[] = $tag->id;
            }
            $photo->tags()->attach($tags);
        }
        return redirect()->route('photos.edit', $photo->id)->with('message' , 'The photo successfully published!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Abort(404);
        /*$photo = Photo::findOrFail($id);
        return '<img src="'.ImageController::showFromSecure($photo->image).'" alt="" title="">';*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $photo = Photo::findOrFail($id);
        $user = Auth::user();

        if($user->cannot("edit", $photo)){
            return redirect()->back()->withErrors('No permission');
        }

        $tags = Tag::all()->pluck('name');
        return view('photos.edit', ['active_menu'=>'myphotos', 'photo'=>$photo, 'tags'=>$tags]);
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
        $validator = $this->validator($request->all(), true);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
            //return redirect()->back()->withErrors('Something wrong, check fields')->withInput();
        }

        $photo = Photo::findOrFail($id);
        $user = Auth::user();

        if($user->cannot("update", $photo)){
            return redirect()->back()->withErrors('No permission');
        }

        $photo->source()->update([
            "title"=>$request->get('title'),
        ]);

        if(!empty($obj = json_decode($request->get('tags')))){
            $tags = null;
            foreach ($obj as $item)
            {
                $tag = Tag::firstOrCreate(['name'=>$item->tag]);
                $tags[] = $tag->id;
            }
            $photo->tags()->sync($tags);
        }else{
            $photo->tags()->detach();
        }

        if($request->hasFile('photo')){
            $old_photo = Image::find($photo->source->id);
            $photo_id = ImageController::store('images/photos/'.$user->id, $request->file('photo'));
            $photo->update(['image_id'=>$photo_id, 'updated_at'=>Carbon::now()]);
            ImageController::destroy($old_photo);
        }

        return redirect()->route('photos.edit', $photo->id)->with('message' , 'The photo successfully updated!');


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
        $photo = Photo::findOrFail($id);

        if($user->cannot("destroy", $photo)){
            return redirect()->back()->withErrors('khkh');
        }

        $photo->favorites()->delete();

        $photo->comments()->delete();

        $old_photo = $photo->source;

        $photo->tags()->detach();

        $photo->delete();

        if(!empty($old_photo)){
                ImageController::destroy($old_photo);
        }

        return redirect()->back()->with('message' , 'The photo successfully deleted!');

    }
}
