<?php

namespace Azizner\Http\Controllers\Comments;

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
            'comment' => ['required', 'string'],
        ];

        return Validator::make($data, $rules);
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

        if($request->get('type') === 'photo') {
            if(!empty($photo = Photo::where('id',$request->get('id'))->first()))
            {
                $photo->comments()->save(new PhotoComment([
                    'user_id'=>$user->id,
                    'comment'=>$request->get('comment')
                ]));
                $response["status"] = "success";
                $response["message"] = "Comment sent";
            }else{
                $response["message"] = "Error";
                $response["status"] = "error";
            }

            echo json_encode($response);
            exit;
        }


        $table['id'] =  $request->get('id');
        $table['comment'] =  $request->get('comment');
        $table['type'] =  $request->get('type');
        echo json_encode($table);
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
