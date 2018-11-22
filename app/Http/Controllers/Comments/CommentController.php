<?php

namespace Azizner\Http\Controllers\Comments;

use Azizner\Notification;
use Azizner\Photo;
use Azizner\PhotoComment;
use Illuminate\Http\Request;
use Azizner\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CommentController extends Controller
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
            'type' => ['required', 'string', 'in:photo'],
            'comment' => ['required', 'string', 'max:100'],
        ];

        return Validator::make($data, $rules);
    }

    public function index()
    {


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
            $response["message"] = "Please try again, make sure the comment field is not empty.";
            echo json_encode($response);
            exit;
        }

        $user = Auth::user();

        if($request->get('type') === 'photo') {
            if(!empty($photo = Photo::where('id',$request->get('id'))->first()))
            {
                $comment = $request->get('comment');
                $photo->comments()->save(new PhotoComment([
                    'user_id'=>$user->id,
                    'comment'=>$comment
                ]));


                $text = 'You have a new <a href="'.route('comments.show', $photo->id).'" class="black-text">comment: </a>'.$comment;

                $photo->user->notifications()->save(new Notification([
                    'from_id'=>$user->id,
                    'text'=>$text
                ]));

                $response["status"] = "success";
                $response["message"] = "Comment sent";
            }else{
                $response["status"] = "error";
                $response["message"] = "Error";
            }

            echo json_encode($response);
            exit;
        }

        $response["status"] = 'error';
        $response["message"] = "Error";
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
        $photo = Photo::findOrFail($id);
        $user = Auth::user();

        if($user->cannot("showComments", $photo)){
            return redirect()->back()->withErrors('No permission');
        }

        $photo->comments()->update(['is_read'=> true]);



        if(empty($photo->comments()->first())){
            return redirect()->route('photos.my')->withErrors('No comments');
        }

        $comments = $photo->comments()->orderBy('created_at', 'desc')->get();

        return view('comments.show', ['comments'=>$comments]);

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
        $comment = PhotoComment::findOrFail($id);

        $user= Auth::user();

        if($user->cannot("destroy", $comment)){
            return redirect()->back()->withErrors('No permission');
        }

        $comment->delete();

        return redirect()->back()->with('message' , 'The comment successfully deleted!');


    }
}
