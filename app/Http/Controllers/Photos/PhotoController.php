<?php

namespace Azizner\Http\Controllers\Photos;

use Azizner\Http\Controllers\ImageController;
use Azizner\Image;
use Azizner\Photo;
use Azizner\Tag;
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

    protected function validator(array $data)
    {
        $rules = [
            'title' => ['nullable', 'string', 'max:100'],
            'photo' => [ 'required', 'image', 'mimes:jpeg,bmp,png', 'max:4096'],
        ];

        return Validator::make($data, $rules);
    }

    public function myPhotos($id = null)
    {
        $user = Auth::user();
        $photos = $user->photos()->paginate(2);
        return view('photos.my', ['photos'=>$photos]);
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
        $user = Auth::user();


        $tags = Tag::all()->pluck('name');
        return view('photos.create', ['tags'=>$tags]);
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
        $photo = Photo::findOrFail($id);
        $user = Auth::user();

        if($user->cannot("edit", $photo)){
            return redirect()->back()->withErrors('No permission');
        }

        $tags = Tag::all()->pluck('name');
        return view('photos.edit', ['photo'=>$photo, 'tags'=>$tags]);
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
