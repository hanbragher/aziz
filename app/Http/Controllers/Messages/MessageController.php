<?php

namespace Azizner\Http\Controllers\Messages;

use Azizner\Http\Controllers\ImageController;
use Azizner\Image;
use Azizner\Message;
use Azizner\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Azizner\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;



class MessageController extends Controller
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
            'to'=>['required', 'string', 'email', 'max:255'],
            'title' => ['required', 'string', 'max:100'],
            'text' => ['nullable','string'],
            'photos' => [ 'max:12' ],
            'photos.*' => [ 'image', 'mimes:jpeg,bmp,png', 'max:2048'],
            /*'post_id' => ['numeric'],
            'destroy' => ['string', 'in:destroy'],*/

        ];

        return Validator::make($data, $rules);
    }


    public function index(Request $request)
    {
        $user = Auth::user();
        $outbox = $request->has('outbox');

        if($outbox){
           $messages = $user->outgoingMSG()->orderBy('created_at', 'desc')->paginate(5);
        }else{
           $messages = $user->incomingMSG()->orderBy('created_at', 'desc')->paginate(5);
        }

        return view('messages.index', ['outbox'=>$outbox, 'messages'=>$messages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('messages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $validator = $this->validator($request->all());
        if($validator->fails()){
            //return redirect()->back()->withErrors($validator)->withInput();
            return redirect(URL::previous().'#!')->withErrors('Something wrong, check fields')->withInput();
        }

        if(!$to = User::where('email', $request->get('to'))->first()){
            return redirect(URL::previous().'#!')->withErrors('Email address is invalid')->withInput();
        }

        $message = $user->outgoingMSG()->save( new Message([
            "title"=>$request->get('title'),
            "text"=>$request->get('text'),
            'to_user'=>$to->id
        ]));

        if($request->hasFile('photos')){
            $image_ids = null;
            foreach ($request->file('photos') as $file){
                $image_ids[] = ImageController::store('messages/'.$user->id.'/'.$message->id, $file, $thumb = [true, 150, 150], true, false);
            }
            $message->images()->attach($image_ids);
        }
        return redirect()->route('messages.index')->with('message' , 'Message sent successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $message = Message::findOrFail($id);
        $user = Auth::user();

        if($user->cannot("show", $message)){
            return redirect()->back()->withErrors('No permission');
        }

        if($message->to->id == $user->id){
            $message->update([
                'is_read'=>true,
                'updated_at'=>Carbon::now()
            ]);
        }
        return view('messages.show', ['message'=>$message]);
    }

    public function downloadAttachment(Request $request)
    {
        //todo policy
        $user = Auth::user();
        $message = Message::findOrFail($request->get('id'));

        if($user->cannot("downloadAttachment", $message)){
            return redirect()->back()->withErrors('No permission');
        }


        $images = $message->images;
        return ImageController::downloadFromSecure($images);

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
