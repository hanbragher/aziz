<?php

namespace Azizner;

use Illuminate\Database\Eloquent\Model;

class PhotoComment extends Model
{
    protected $table  = 'photo_comments';
    protected $fillable = ['user_id', 'photo_id', 'comment'];

    public function user(){
        return $this->belongsTo("Azizner\User", "user_id", "id");
    }
}
