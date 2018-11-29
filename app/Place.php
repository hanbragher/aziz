<?php

namespace Azizner;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $table  = 'places';
    public $appends = ['image', 'thumb'];
    protected $fillable = ['name', 'inf', 'map', 'main_image', 'user_id', 'category_id', 'country_id', 'region_id', 'city_id', 'is_moderated'];

    public function user(){
        return $this->belongsTo("Azizner\User", "user_id", "id");
    }

    public function category(){
        return $this->hasOne("Azizner\Category", "id", "category_id");
    }

    public function country(){
        return $this->hasOne("Azizner\Country", "id", "country_id");
    }

    public function region(){
        return $this->hasOne("Azizner\Region", "id", "region_id");
    }

    public function city(){
        return $this->hasOne("Azizner\City", "id", "city_id");
    }

    public function notes(){
        return $this->hasMany("Azizner\Note", "place_id", 'id');
    }

    public function favorites(){
        return $this->hasMany("Azizner\Favorite_Places", "place_id", 'id');
    }

    public function stars(){
        if($this->favorites->first()){
            return $this->favorites->count();
        }
        return '-';
    }

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
