<?php

namespace Azizner;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table  = 'posts';
    public $appends = ['image'];
    protected $fillable = ['blogger_id', 'title','text','main_image', 'updated_at'];

    public function tags(){
        return $this->belongsToMany("Azizner\Tag", "post_tag");
    }

    public function images(){
        return $this->belongsToMany("Azizner\Image", "post_image");
    }

    public function main_img(){
        return $this->belongsTo("Azizner\Image", "main_image", "id");
    }

    public function blogger(){
        return $this->belongsTo("Azizner\Blogger", "blogger_id", "id");
    }

    public function getImageAttribute()
    {
        if($this->main_img){
            return $this->main_img->file;
        }else{
            return '/images/card.jpg';
        }
    }


}