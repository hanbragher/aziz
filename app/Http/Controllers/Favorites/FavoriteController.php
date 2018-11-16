<?php

namespace Azizner\Http\Controllers\Favorites;

use Azizner\Announcement;
use Illuminate\Http\Request;
use Azizner\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware(['auth']);
    }

    protected function validator(array $data)
    {
        $rules = [
            'id' => ['nullable', 'numeric'],
        ];

        return Validator::make($data, $rules);
    }

    public function index()
    {
        $user = Auth::user();
        $announcements = $user->favoriteAnnouncements()->paginate(2);
        return view('favorites.index', ['announcements'=>$announcements]);
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
        $response = [];

        $validator = $this->validator($request->all());
        if($validator->fails()){
            $response["status"] = "error";
            echo json_encode($response);
            exit;
        }

        $user = Auth::user();

        if(!empty($announcement = Announcement::where('id',$request->get('id'))->first()))
        {
            if($user->favoriteAnnouncements->contains($announcement->id))
            {
                $user->favoriteAnnouncements()->detach($announcement->id);
            }else{
                $user->favoriteAnnouncements()->attach($announcement->id);
            }
            $response["status"] = "success";

        }else{
            $response["status"] = "error";
        }

        echo json_encode($response);
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
