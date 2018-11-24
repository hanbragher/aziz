<?php

namespace Azizner;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $table  = 'places';
    //public $appends = ['image', 'thumb', 'title'];
    protected $fillable = ['name', 'inf', 'map', 'main_image', 'user_id'];

    public function tags(){
        return $this->belongsToMany("Azizner\Tag", "place_tag");
    }

    public function images(){
        return $this->belongsToMany("Azizner\Image", "place_image");
    }
}
