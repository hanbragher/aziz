<?php

namespace Azizner;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table  = 'notes';
    protected $fillable = ['user_id', 'place_id', 'text'];

    public function user(){
        return $this->belongsTo("Azizner\User", "user_id", "id");
    }

    public function place(){
        return $this->belongsTo("Azizner\Place", "place_id", "id");
    }

    public function images(){
        return $this->belongsToMany("Azizner\Image", "note_images");
    }



}
