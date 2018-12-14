<?php

namespace Azizner\Http\Controllers\Notes;

use Azizner\Http\Controllers\ImageController;
use Azizner\Image;
use Azizner\Note;
use Azizner\Place;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Azizner\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware(['auth'])->only(['create', 'edit', 'store', 'update', 'destroy', 'myNotes']);
    }

    protected function validator(array $data)
    {
        $rules = [
            'text' => ['nullable', 'string'],
            'images' => [ 'max:12' ],
            'images.*' => [ 'image', 'mimes:jpeg,bmp,png', 'max:2048'],
            'image_id' => ['numeric'],
        ];

        return Validator::make($data, $rules);
    }


    public function index()
    {
        //return view('notes.index');
    }

    public function myNotes()
    {
        $user = Auth::user();

        $notes = $user->notes()->orderBy('created_at', 'desc')->paginate(5);

        return view('notes.my', ['notes'=>$notes, 'active_menu'=>'mynotes']);
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

        $validator = $this->validator($request->all());
        if($validator->fails()){
            //return redirect()->back()->withErrors($validator)->withInput();
            return redirect()->back()->withErrors('Something wrong, check fields')->withInput();
        }

        if(!$place = Place::where('id', $request->get('id'))->first()){
            return redirect()->back()->withErrors('No permissions, refresh page and try again')->withInput();
        }


        $user = Auth::user();

        $note = $user->notes()->save(new Note([
            'text' => $request->get('text'),
            'place_id' => $place->id,
        ]));

        if($request->hasFile('images')){
            $image_ids = null;
            foreach ($request->file('images') as $file){
                $image_ids[] = ImageController::store('images/notes/'.$place->id, $file, $thumb = [true, 50, 50]);
            }
            $note->images()->attach($image_ids);
        }

        return redirect()->route('places.show', ['id'=>$place->id, '#notes'])->with('message' , 'The note successfully published!');
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
        $note = Note::findOrFail($id);
        $user = Auth::user();

        if($user->cannot("edit", $note)){
            return redirect()->back()->withErrors('No permissions');
        }


        return view('notes.edit', ['note'=>$note, 'active_menu'=>'mynotes']);
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
            return redirect()->back()->withErrors('Something wrong, check fields')->withInput();
        }

        $user = Auth::user();

        if(!$note = Note::where('id', $id)->first()){
            return redirect()->back()->withErrors('No permissions')->withInput();
        }

        if(!$place = $note->place){
            return redirect()->back()->withErrors('Error, Place has been deleted')->withInput();
        }


        if($user->cannot("update", $note)){
            return redirect()->back()->withErrors('No permissions');
        }

        $note->update(
            [
                'text'=>$request->get('text'),
                'updated_at'=>Carbon::now()
            ]);

        if($request->hasFile('images')){
            $image_ids = null;
            foreach ($request->file('images') as $file){
                $image_ids[] = ImageController::store('images/notes/'.$place->id, $file, $thumb = [true, 50, 50]);
            }
            $note->images()->attach($image_ids);
        }


        if($request->has('image_id') and $request->has('destroy')){

            if(empty($old_image = Image::where('id', $request->get('image_id'))->first())){
                return redirect()->back()->withErrors('Permission denied');
            };

            if($request->get('destroy') == 'destroy'){
                $note->images()->detach($request->get('image_id'));
                ImageController::destroy($old_image);
                $note->update(['updated_at'=>Carbon::now()]);
                return redirect()->back()->with('message' , 'Picture has been deleted!');
            }

            return redirect()->back()->withErrors('Permission denied');
        }

        return redirect()->back()->with('message' , 'Note has been updated!');
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

        if(!$note = Note::where('id', $id)->first()){
            return redirect()->back()->withErrors('No permissions, refresh page and try again')->withInput();
        }

        if($user->cannot("destroy", $note)){
            return redirect()->back()->withErrors('No permissions');
        }

        if($note->images->first()){
            $old_images = $note->images;
            $note->images()->detach();
            if(!empty($old_images)){
                foreach ($old_images as $image){
                    ImageController::destroy($image);
                }
            }
        }

        $note->delete();

        return redirect()->back()->with('message' , 'Note has been deleted!');

    }
}
