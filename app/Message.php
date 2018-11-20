<?php

namespace Azizner;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table  = 'messages';
    public $appends = ['title'];
    protected $fillable = ['title', 'text', 'from_user', 'to_user', 'is_read', 'skip_inbox', 'skip_outbox'];

    public function from(){
        return $this->belongsTo("Azizner\User", "from_user", "id");
    }

    public function to(){
        return $this->belongsTo("Azizner\User", "to_user", "id");
    }

    public function images(){
        return $this->belongsToMany("Azizner\Image", "message_image");
    }

    public function  hasAttachments(){
        if($this->images()->first()){
            return true;
        }
        return false;
    }


}
