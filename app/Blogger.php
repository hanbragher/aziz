<?php

namespace Azizner;

use Illuminate\Database\Eloquent\Model;

class Blogger extends Model
{
    protected $table  = 'bloggers';
    public $timestamps = false;
    protected $fillable = ['user_id', 'name', 'description', 'avatar_id', 'cover_id'];

    public function posts(){
        return $this->hasMany("Azizner\Post", "blogger_id", "id");
    }

    public function user(){
        return $this->belongsTo("Azizner\User", "user_id", "id");
    }

    public function cover(){
        return $this->hasOne("Azizner\Image", "id", "cover_id");
    }
}
