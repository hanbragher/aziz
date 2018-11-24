<?php

namespace Azizner\Http\Controllers\Favorites;

use Azizner\Announcement;
use Azizner\Notification;
use Azizner\Photo;
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
            'id' => ['required', 'numeric'],
            'type' => ['required', 'string', 'in:announcement,photo'],
        ];

        return Validator::make($data, $rules);
    }



    public function announcements()
    {
        $user = Auth::user();
        $announcements = $user->favoriteAnnouncements()->paginate(2);
        return view('favorites.announcements', ['announcements'=>$announcements, 'active'=>'announcements']);
    }

    public function photos()
    {
        $user = Auth::user();
        $photos = $user->favoritePhotos()->paginate(2);
        return view('favorites.photos', ['photos'=>$photos, 'active'=>'photos']);
    }

    public function index(Request $request)
    {

        if($request->has('photos') or empty($request->all())){
            return $this->photos();
        }

        if($request->has('announcements')){
            return $this->announcements();
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
            $response["status"] = 'error';
            echo json_encode($response);
            exit;
        }

        $user = Auth::user();

        if($request->get('type') === 'announcement'){
            if(!empty($announcement = Announcement::where('id',$request->get('id'))->first()))
            {
                if($user->favoriteAnnouncements->contains($announcement->id))
                {
                    $user->favoriteAnnouncements()->detach($announcement->id);
                }else{

                    $announcement->user->notifications()->save(new Notification([
                        'from_id'=>$user->id,
                        'type'=>'announcement',
                        'type_id'=>$announcement->id,
                        'text'=>null
                    ]));

                    $user->favoriteAnnouncements()->attach($announcement->id);
                }
                $response["status"] = "success";

            }else{
                $response["status"] = "error";
            }

            echo json_encode($response);
            exit;
        }

        if($request->get('type') === 'photo') {
            if(!empty($photo = Photo::where('id',$request->get('id'))->first()))
            {
                if($user->favoritePhotos->contains($photo->id))
                {
                    $user->favoritePhotos()->detach($photo->id);
                }else{

                    $photo->user->notifications()->save(new Notification([
                        'from_id'=>$user->id,
                        'type'=>'photo_star',
                        'type_id'=>$photo->id,
                        'text'=>null
                    ]));

                    $user->favoritePhotos()->attach($photo->id);
                }
                $response["status"] = "success";

            }else{
                $response["status"] = "error";
            }

            echo json_encode($response);
            exit;
        }


        $response["status"] = 'error';
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
