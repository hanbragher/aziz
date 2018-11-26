<?php

namespace Azizner;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table  = 'posts';
    public $appends = ['image', 'thumb'];
    protected $fillable = ['blogger_id', 'title','text', 'main_image', 'updated_at'];

    public function tags(){
        return $this->belongsToMany("Azizner\Tag", "post_tag");
    }

    public function images(){
        return $this->belongsToMany("Azizner\Image", "post_image");
    }

    public function img(){
        return $this->belongsTo("Azizner\Image", "main_image", "id");
    }

    public function blogger(){
        return $this->belongsTo("Azizner\Blogger", "blogger_id", "id");
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
