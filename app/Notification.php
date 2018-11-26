<?php

namespace Azizner;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table  = 'notifications';
    protected $fillable = ['user_id', 'from_id', 'type', 'type_id', 'text'];

    public function user(){
        return $this->belongsTo("Azizner\User", "user_id", "id");
    }

    public function from(){
        return $this->belongsTo("Azizner\User", "from_id", "id");
    }

    public function thumb(){
        if($this->type == 'photo_comment' or $this->type == 'photo_star'){
            if(!empty($photo = Photo::where('id',$this->type_id)->first())){
                return $photo->thumb;
            }
        }elseif($this->type == 'message'){
            if(!empty($message = Message::where('id',$this->type_id)->first())){
                return $message->from->thumb;
            }
        }elseif($this->type == 'announcement'){
            if(!empty($announcement = Announcement::where('id',$this->type_id)->first())){
                return $announcement->thumb;
            }
        };

        return false;
    }

    public function href(){
        if($this->type == 'photo_comment'){
            if(!empty($photo = Photo::where('id',$this->type_id)->first())){
                $link = 'You have a <b><a href="'.route('photos.comments', $photo->id).'" class="grey-text">new comment for photo<i class="material-icons tiny">open_in_new</i>: </a></b>'.$this->text;
                return $link;
            }else{
                return 'You have a new comment for photo:'.$this->text;
            }
        }elseif($this->type == 'photo_star'){
            if(!empty($photo = Photo::where('id',$this->type_id)->first())){
                $link = '<b><a href="'.route('photos.comments', $photo->id).'" class="grey-text">Your photo<i class="material-icons tiny">open_in_new</i></a></b> have one more star';
                return $link;
            }else{
                return 'Your photo have one more star';
            }
        }elseif($this->type == 'message'){
            if(!empty($message = Message::where('id',$this->type_id)->first())){
                $link = 'You have a <b><a href="'.route('messages.show', $message->id).'" class="grey-text">new message<i class="material-icons tiny">open_in_new</i></a></b>';
                return $link;
            }else{
                return 'You have a new message.';
            }
        }elseif($this->type == 'announcement'){
            if(!empty($announcement = Announcement::where('id',$this->type_id)->first())){
                $link = '<b><a href="'.route('announcements.show', $announcement->id).'" class="grey-text">Your announcement<i class="material-icons tiny">open_in_new</i></a></b> have one more star';
                return $link;
            }else{
                return 'Your announcement have one more star.';
            }
        };

        return false;
    }
}
