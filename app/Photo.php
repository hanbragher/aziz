<?php

namespace Azizner;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table  = 'photos';
    public $appends = ['image', 'thumb', 'title'];
    protected $fillable = ['image_id', 'thumb', 'title'];

    public function user(){
        return $this->belongsTo("Azizner\User", "user_id", "id");
    }

    public function favorites(){
        return $this->hasMany("Azizner\Favorite_Photos", "photo_id", "id");
    }

    public function source(){
        return $this->belongsTo("Azizner\Image", "image_id", "id");
    }

    public function tags(){
        return $this->belongsToMany("Azizner\Tag", "photo_tags");
    }

    public function stars(){
        if($this->favorites->first()){
            return $this->favorites->count();
        }
        return '-';
    }

    public function comments(){
        return $this->hasMany("Azizner\PhotoComment", "photo_id", 'id');
    }

    public function hasNewComment()
    {
        if($this->comments()->where('is_read', false)->first()){
            return true;
        }
        return false;
    }

    public function getImageAttribute()
    {
        if($this->source){
            return $this->source->file;
        }else{
            return '/images/card.jpg';
        }
    }

    public function getThumbAttribute()
    {
        if($this->source){
            return $this->source->thumb;
        }else{
            return '/images/card.jpg';
        }
    }

    public function getTitleAttribute()
    {
        if($this->source){
            return $this->source->title;
        }else{
            return null;
        }
    }


}
