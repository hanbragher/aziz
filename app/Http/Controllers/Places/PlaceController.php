<?php

namespace Azizner\Http\Controllers\Places;

use Azizner\Category;
use Azizner\City;
use Azizner\Country;
use Azizner\Group;
use Azizner\Http\Controllers\ImageController;
use Azizner\Image;
use Azizner\Place;
use Azizner\Region;
use Azizner\Tag;
use Carbon\Carbon;
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
            'map' => ['nullable', 'string'],
            'image_id' => ['numeric'],
            'place_id' => ['numeric'],
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
            return redirect()->back()->withErrors('No permission, you should be moderator for a create new place');
        }


        $countries = Country::all()->pluck('name');
        $regions = Region::orderBy('name')->pluck('name');
        $cities = City::all()->pluck('name');
        $categories = Category::orderBy('name')->pluck('name');

        $tags = Tag::all()->pluck('name');
        return view('places.create', ['tags'=>$tags, 'countries'=>$countries, 'regions'=>$regions, 'cities'=>$cities, 'categories'=>$categories ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function map($get_map){
        if(!str_contains($get_map,'www.google.com/maps/embed') and !str_contains($get_map,'yandex.ru/map')){
            return redirect()->back()->withErrors('Please check map frame.')->withInput();
        }

        $array = ['width="400"', 'width="560"', 'width="600"', 'width="800"'];
        return str_replace($array,'width="100%"', $get_map);

    }


    public function store(Request $request)
    {
        dump($request->all());
        exit;

        $validator = $this->validator($request->all());
        if($validator->fails()){
            //return redirect()->back()->withErrors($validator)->withInput();
            return redirect()->back()->withErrors('Something wrong, check fields')->withInput();
        }
        $user = Auth::user();

        if(!$user->is_moderator){
            return redirect()->back()->withErrors('No permission, you should be moderator for a create new place');
        }

        $map = $this->map($request->get('map'));

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
        $place = Place::findOrFail($id);
        $user = Auth::user();

        if($user->cannot("edit", $place)){
            return redirect()->back()->withErrors('No permission.');
        }

        $tags = Tag::all()->pluck('name');
        return view('places.edit', ['place'=>$place, 'tags'=>$tags]);
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
        /*dump($request->all());
        dump($request->has('map'));


        exit;*/


        $validator = $this->validator($request->all());
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
            //return redirect()->back()->withErrors('Something wrong, check fields')->withInput();
        }

        $user = Auth::user();
        $place = Place::findOrFail($id);

        if($user->cannot("update", $place)){
            return redirect()->back()->withErrors('Permission denied');
        }

        if($request->has('image_id') and $request->has('place_id')) {
            if(empty($old_image = Image::where('id', $request->get('image_id'))->first())){
                return redirect()->back()->withErrors('Permission denied');
            };


            if (empty($old_image->places->where('id', $id)->first())) {
                return redirect()->back()->withErrors('Permission denied');
            };


            if($request->get('destroy') == 'destroy'){
                $place->images()->detach($request->get('image_id'));
                ImageController::destroy($old_image);
                $place->update(['updated_at'=>Carbon::now()]);
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



        if(!empty($request->get('map'))){
            $map = $this->map($request->get('map'));
            $place->update([
                "name"=>$request->get('name'),
                "inf"=>$request->get('inf'),
                "map"=>$map,
                'updated_at'=>Carbon::now()
            ]);
        }else{
            $place->update([
                "name"=>$request->get('name'),
                "inf"=>$request->get('inf'),
                'updated_at'=>Carbon::now()
            ]);
        }


        if(!empty($obj = json_decode($request->get('tags')))){
            $tags = null;
            foreach ($obj as $item)
            {
                $tag = Tag::firstOrCreate(['name'=>$item->tag]);
                $tags[] = $tag->id;
            }
            $place->tags()->sync($tags);
        }else{
            $place->tags()->detach();
        }


        if($request->hasFile('main_image')){
            $old_main_image = Image::find($place->main_image);
            $main_image_id = ImageController::store('images/places/'.$user->id.'/'.$place->id, $request->file('main_image'));
            $place->update(['main_image'=>$main_image_id]);
            ImageController::destroy($old_main_image);
        }

        if($request->hasFile('gallery')){
            $can_upload = 12-$place->images->count();
            $uploaded = count($request->file('gallery'));
            if($can_upload <= $uploaded-1){
                return redirect()->back()->withErrors('Total count images of gallery should not be more 12 psc.')->withInput();
            }
            $image_ids = null;
            foreach ($request->file('gallery') as $file){
                $image_ids[] = ImageController::store('images/places/'.$user->id.'/'.$place->id, $file);
            }
            $place->images()->attach($image_ids);
        }

        return redirect()->back()->with('message' , 'The place successfully updated!');
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
