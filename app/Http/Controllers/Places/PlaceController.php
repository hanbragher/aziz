<?php

namespace Azizner\Http\Controllers\Places;

use Azizner\Category;
use Azizner\City;
use Azizner\Country;
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
use Illuminate\Support\Facades\File;



class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware(['auth'])->only(['create', 'edit', 'store', 'update', 'destroy', 'myPlaces', 'showMy']);
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
            'category' => ['nullable', 'regex:/^[a-zA-Z ]+$/'],
            'country' => ['required_without:image_id', 'regex:/^[a-zA-Z ]+$/'],
            'region' => ['required_without:image_id', 'regex:/^[a-zA-Z ]+$/'],
            'city' => ['required_without:image_id', 'regex:/^[a-zA-Z ]+$/'],
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

        $place = $request->get('place');

        if(empty($place) or $place == 'all'){
            $category = Category::where('name', 'all')->first();
            $places = Place::where('is_moderated', true)->orderBy('created_at', 'desc');
        }elseif($category = Category::where('name', $place)->first()){
            $places = Place::where(['is_moderated'=> true, 'category_id'=>$category->id])->orderBy('created_at', 'desc');
        }

        if(!empty($places)){
            return view('places.index', ['places'=>$places->paginate(2), 'category'=>$category, 'place_menu'=>$place, 'active_menu'=>'places']);
        }

        return Abort(404);


    }

    public function myPlaces(Request $request)
    {
        $user = Auth::user();
        $places = $user->places()->paginate(2);

        return view('places.my', [ 'active_menu'=>'myplaces', 'places'=>$places]);

    }


    public function show($id)
    {

        if(!$place = Place::where('id', $id)->first()){
            return Abort(404);
        }

        if(!$place->is_moderated){
            return Abort(404);
        }

        $notes = $place->notes()->orderBy('created_at', 'desc')->get();
        $place_menu = $place->category->name;
        return view('places.show', ['place'=>$place, 'notes'=>$notes, 'place_menu'=>$place_menu, 'active_menu'=>'places']);
    }


    public function readNotes($id)
    {

        if(!$place = Place::where('id', $id)->first()){
            return Abort(404);
        }

        $user = Auth::user();

        if($user->cannot("update", $place)){
            return redirect()->back()->withErrors('No permission.');
        }

        if($place->hasNewNote()){
            $place->notes()->update([
                'is_read'=>true,
            ]);
        }

        return redirect()->route('places.show', [$id, '#notes']);

    }


    public function create()
    {
        $user = Auth::user();

        if(!$user->is_moderator){
            return redirect()->back()->withErrors('No permission, you should be moderator for a create new place');
        }

        $countries = Country::all()->pluck('name');
        $regions = Region::orderBy('name')->pluck('name');
        $cities = City::orderBy('name')->pluck('name');
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
        if(!empty($get_map)){
            if(!str_contains($get_map,'www.google.com/maps/embed') and !str_contains($get_map,'yandex.ru/map')){
                return 'error';
            }

            $array = ['width="400"', 'width="560"', 'width="600"', 'width="800"'];
            return str_replace($array,'width="100%"', $get_map);
        }

        return null;
    }


    public function store(Request $request)
    {

        $validator = $this->validator($request->all());
        if($validator->fails()){
            //return redirect()->back()->withErrors($validator)->withInput();
            return redirect()->back()->withErrors('Please check fields')->withInput();
        }

        $user = Auth::user();

        if(!$user->is_moderator){
            return redirect()->back()->withErrors('No permission, you should be moderator for a create new place');
        }

        if(!empty($request->get('category'))){
            if(!$category = Category::where('name',  $request->get('category'))->first()){
                return redirect()->back()->withErrors('Check category field');
            }
            $category_id = $category->id;
        }else{
            $category_id = Category::where('name',  "without category")->first()->id;
        }


        if(!$country = Country::where('name', $request->get('country'))->first()){
            return redirect()->back()->withErrors('Check country field');
        }

        if(!$region = Region::where(['name'=>$request->get('region'), 'country_id'=>$country->id])->first()){
            return redirect()->back()->withErrors('Check state/region field');
        }

        $map = $this->map($request->get('map'));

        if($map == 'error'){
            return redirect()->back()->withErrors('Please check map frame.')->withInput();
        }

        $city = City::firstOrCreate(['name'=>$request->get('city'), 'region_id'=>$region->id]);

        $place = $user->places()->save( new Place([
            "name"=>$request->get('name'),
            "inf"=>$request->get('inf'),
            "map"=>$map,
            "category_id"=>$category_id,
            "country_id"=>$country->id,
            "region_id"=>$region->id,
            "city_id"=>$city->id,
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

        $categories = Category::orderBy('name')->pluck('name');
        $countries = Country::all()->pluck('name');
        $regions = Region::orderBy('name')->pluck('name');
        $cities = City::orderBy('name')->pluck('name');

        $tags = Tag::all()->pluck('name');
        return view('places.edit', ['place'=>$place, 'tags'=>$tags, 'categories'=>$categories, 'countries'=>$countries, 'regions'=>$regions, 'cities'=>$cities]);
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
            //return redirect()->back()->withErrors($validator)->withInput();
            return redirect()->back()->withErrors('Please check fields')->withInput();
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

        if(!empty($request->get('category'))){
            if(!$category = Category::where('name',  $request->get('category'))->first()){
                return redirect()->back()->withErrors('Check category field');
            }
            $category_id = $category->id;
        }else{
            $category_id = Category::where('name',  "without category")->first()->id;
        }

        if(!$country = Country::where('name', $request->get('country'))->first()){
            return redirect()->back()->withErrors('Check country field');
        }

        if(!$region = Region::where(['name'=>$request->get('region'), 'country_id'=>$country->id])->first()){
            return redirect()->back()->withErrors('Check state/region field');
        }




        $city = City::firstOrCreate(['name'=>$request->get('city'), 'region_id'=>$region->id]);



        if(!empty($request->get('map'))){
            $map = $this->map($request->get('map'));
            if($map == 'error'){
                return redirect()->back()->withErrors('Please check map frame.')->withInput();
            }
            $place->update([
                "name"=>$request->get('name'),
                "inf"=>$request->get('inf'),
                "map"=>$map,
                "category_id"=>$category_id,
                "country_id"=>$country->id,
                "region_id"=>$region->id,
                "city_id"=>$city->id,
                'updated_at'=>Carbon::now()
            ]);
        }else{
            $place->update([
                "name"=>$request->get('name'),
                "inf"=>$request->get('inf'),
                "category_id"=>$category_id,
                "country_id"=>$country->id,
                "region_id"=>$region->id,
                "city_id"=>$city->id,
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
        $user = Auth::user();
        $place = Place::findOrFail($id);

        if($user->cannot("destroy", $place)){
            return redirect()->back()->withErrors('khkh');
        }

        $place->favorites()->delete();

        if($place->notes->first()){
            foreach ($place->notes as $note){
                    if($note->images->first()){
                        $old_note_images = $note->images;
                        $note->images()->detach();
                        if(!empty($old_note_images)){
                            foreach ($old_note_images as $image){
                                ImageController::destroy($image);
                            }
                        }
                    }
                $note->delete();
            }

            if(is_dir(public_path('images/notes/'.$place->id))){
                File::deleteDirectory(public_path('images/notes/'.$place->id));
            }

        }


        $old_images = $place->images;
        $place->images()->detach();

        $place->tags()->detach();

        if(!empty($old_images)){
            foreach ($old_images as $image){
                ImageController::destroy($image);
            }
        }

        if($main_image_id = $place->main_image){
            $main_image = Image::find($main_image_id);
        }else{
            $main_image = null;
        }

        if(is_dir(public_path('images/places/'.$user->id.'/'.$place->id))){
            File::deleteDirectory(public_path('images/places/'.$user->id.'/'.$place->id));
        }

        $place->delete();

        ImageController::destroy($main_image);

        return redirect()->back()->with('message' , 'The place successfully deleted!');
    }
}
