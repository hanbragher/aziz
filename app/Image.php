<?php

namespace Azizner;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table  = 'images';
    public $timestamps = false;
    protected $fillable = ['file', 'thumb', 'title'];


   public function posts(){
        return $this->belongsToMany("Azizner\Post", "post_image");
   }

   public function places(){
        return $this->belongsToMany("Azizner\Place", "place_image");
   }

   public function announcements(){
        return $this->belongsToMany("Azizner\Announcement", "announcement_image");
   }

   public function notes(){
        return $this->belongsToMany("Azizner\Note", "note_images");
   }
}
