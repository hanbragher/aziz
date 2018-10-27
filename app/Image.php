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
}
