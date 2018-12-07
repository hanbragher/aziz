<?php

namespace Azizner\Http\Controllers\Admin\Places;

use Azizner\Category;
use Azizner\City;
use Azizner\Country;
use Azizner\Place;
use Azizner\Region;
use Azizner\Tag;
use Illuminate\Http\Request;
use Azizner\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $place = $request->get('place');
        $categories = Category::all()->whereNotIn('name', 'all')->pluck('name');

        if(empty($place) or $place == 'all'){
            $category = 'all';
            $places = Place::orderBy('created_at', 'desc');
        }elseif($category_check = Category::where('name', $place)->first()){
            $category = $category_check->name;
            $places = Place::where(['category_id'=>$category_check->id])->orderBy('created_at', 'desc');
        }elseif($place == 'not_moderated'){
            $category = 'not_moderated';
            $places = Place::where(['is_moderated'=>false])->orderBy('created_at', 'desc');
        }

        if(!empty($places)){
            return view('admin.places.index', ['places'=>$places->paginate(2), 'categories'=>$categories, 'active'=>$category]);

            //return view('places.index', ['places'=>$places->paginate(2), 'category'=>$category, 'place_menu'=>$place, 'active_menu'=>'places']);
        }

        return Abort(404);

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

    public function moderate($id)
    {
        if(!$place = Place::where('id', $id)->first()){
            return redirect()->back()->withErrors('The place does not exist.')->withInput();
        }

        if(!$place->is_moderated){
            $place->update(['is_moderated'=>true]);
        }else{
            $place->update(['is_moderated'=>false]);
        }

        return redirect()->back()->with('message' , 'The place moderate status change!');

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
