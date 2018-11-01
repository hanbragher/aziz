<?php

namespace Azizner;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table  = 'tags';
    public $timestamps = false;
    protected $fillable = ['name'];

    public function posts(){
        return $this->belongsToMany("Azizner\Post", 'post_tag');
    }

    public function announcements(){
        return $this->belongsToMany("Azizner\Announcement", 'announcement_tags');
    }
}
