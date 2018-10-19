<?php

namespace Azizner;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table  = 'tags';
    public $timestamps = false;
    protected $fillable = ['name'];

    public function posts(){
        return $this->belongsToMany("azizner\Post", 'post_tag');
    }
}
