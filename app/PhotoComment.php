<?php

namespace Azizner;

use Illuminate\Database\Eloquent\Model;

class PhotoComment extends Model
{
    protected $table  = 'photo_comments';
    protected $fillable = ['user_id', 'photo_id', 'comment', 'is_read'];

    public function user(){
        return $this->belongsTo("Azizner\User", "user_id", "id");
    }

    public function photo(){
        return $this->belongsTo("Azizner\Photo", "photo_id", "id");
    }


}
