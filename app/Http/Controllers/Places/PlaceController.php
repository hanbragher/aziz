<?php

namespace Azizner\Http\Controllers\Places;

use Azizner\Group;
use Azizner\Http\Controllers\ImageController;
use Azizner\Place;
use Azizner\Tag;
use Illuminate\Http\Request;
use Azizner\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware(['auth'])->only(['create', 'edit', 'store', 'update', 'destroy', 'myPlaces']);
    }

    protected function validator(array $data)
    {
        $rules = [
            'name' => ['required_without:image_id', 'string', 'max:100'],
            'main_image' => [ 'image', 'mimes:jpeg,bmp,png', 'max:2048'],
            'gallery' => [ 'max:12' ],
            'gallery.*' => [ 'image', 'mimes:jpeg,bmp,png', 'max:2048'],
            'inf' => ['required_without:image_id', 'string'],
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
        //dump($request->all());
        //exit;

        return view('places.index', ['place'=>$request->get('place'), 'active_menu'=>'places']);

    }

    public function myPlaces(Request $request)
    {
        //dump($request->all());
        //exit;

        return view('places.my', [ 'active_menu'=>'myplaces']);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        if(!$user->is_moderator){
            return redirect()->back()->withErrors('No permission, you should be blogger for a create new post');
        }
        $tags = Tag::all()->pluck('name');
        return view('places.create', ['tags'=>$tags]);
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

        if(!$user->is_moderator){
            return redirect()->back()->withErrors('No permission, you should be moderator for a create new place');
        }

        $frame = $request->get('map');
        if(!str_contains($frame,'www.google.com/maps/embed') and !str_contains($frame,'yandex.ru/map')){
            return redirect()->back()->withErrors('Please check map frame.')->withInput();
        }

        $array = ['width="400"', 'width="560"', 'width="600"', 'width="800"'];
        $map = str_replace($array,'width="100%"', $frame);

        $place = $user->places()->save( new Place([
            "name"=>$request->get('name'),
            "inf"=>$request->get('inf'),
            "map"=>$map,
        ]));

        if(!empty($obj = json_decode($request->get('tags')))){
            $tags = null;
            foreach ($obj as $item)
            {
                $tag = Tag::firstOrCreate(['name'=>$item->tag]);
                $tags[] = $tag->id;
            }
            $place->tags()->attach($tags);
        }

        if($request->hasFile('main_image')){
            $main_image_id = ImageController::store('images/places/'.$user->id.'/'.$place->id, $request->file('main_image'));
            $place->update(['main_image'=>$main_image_id]);
        }

        if($request->hasFile('gallery')){
            $image_ids = null;
            foreach ($request->file('gallery') as $file){
                $image_ids[] = ImageController::store('images/places/'.$user->id.'/'.$place->id, $file);
            }
            $place->images()->attach($image_ids);
        }

        return redirect()->route('places.edit', $place->id)->with('message' , 'The place successfully published!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('places.show', ['active_menu'=>'places']);
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
