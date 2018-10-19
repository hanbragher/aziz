<?php

namespace Azizner;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table  = 'images';
    public $timestamps = false;
    protected $fillable = ['file'];


    public function posts(){
        return $this->belongsToMany("azizner\Post", "post_image");
    }
}
