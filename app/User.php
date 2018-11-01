<?php

namespace Azizner;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'is_blogger', 'is_moderator', 'avatar_id', 'cover_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function avatar(){
        return $this->hasOne("Azizner\Image", "id", "avatar_id");
    }

    public function cover(){
        return $this->hasOne("Azizner\Image", "id", "cover_id");
    }

    public function blog(){
        return $this->belongsTo("Azizner\Blogger", "id", "user_id");
    }
    
    public function notes(){
        return $this->hasMany("Azizner\Note", "user_id", "id");
    }

    public function announcements(){
        return $this->hasMany("Azizner\Announcement", "user_id", "id");
    }





}
