<?php

namespace Azizner;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $table  = 'places';
    public $appends = ['image', 'thumb'];
    protected $fillable = ['name', 'inf', 'map', 'main_image', 'user_id', 'is_moderated'];

    public function tags(){
        return $this->belongsToMany("Azizner\Tag", "place_tag");
    }

    public function images(){
        return $this->belongsToMany("Azizner\Image", "place_image");
    }

    public function img(){
        return $this->belongsTo("Azizner\Image", "main_image", "id");
    }

    public function getImageAttribute()
    {
        if($this->main_image){
            return $this->img->file;
        }else{
            return '/images/card.jpg';
        }
    }

    public function getThumbAttribute()
    {
        if($this->main_image){
            return $this->img->thumb;
        }else{
            return '/images/card.jpg';
        }
    }
}
