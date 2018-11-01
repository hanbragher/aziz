<?php

namespace Azizner;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $table  = 'announcements';
    public $appends = ['image', 'thumb'];
    protected $fillable = ['title', 'text', 'user_id', 'main_image'];

    public function tags(){
        return $this->belongsToMany("Azizner\Tag", "announcement_tags");
    }

    public function images(){
        return $this->belongsToMany("Azizner\Image", "announcement_image");
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
