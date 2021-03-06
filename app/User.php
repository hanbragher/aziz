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
    public $appends = ['avatar', 'thumb'];

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

    public function my_avatar(){
        return $this->hasOne("Azizner\Image", "id", "avatar_id");
    }

    public function getAvatarAttribute()
    {
        if($this->my_avatar){
            return $this->my_avatar->file;
        }else{
            return '/images/user_avatar.png';
        }
    }

    public function getThumbAttribute()
    {
        if($this->my_avatar){
            return $this->my_avatar->thumb;
        }else{
            return '/images/user_avatar.png';
        }
    }

    public function cover(){
        return $this->hasOne("Azizner\Image", "id", "cover_id");
    }

    public function blog(){
        return $this->belongsTo("Azizner\Blogger", "id", "user_id");
    }

    public function incomingMSG(){
        return $this->hasMany("Azizner\Message", "to_user", "id")->where('skip_inbox', false);
    }


    public function outgoingMSG(){
        return $this->hasMany("Azizner\Message", "from_user", "id")->where('skip_outbox', false);
    }


    public function notes(){
        return $this->hasMany("Azizner\Note", "user_id", "id");
    }

    public function announcements(){
        return $this->hasMany("Azizner\Announcement", "user_id", "id");
    }

    public function notifications(){
        return $this->hasMany("Azizner\Notification", "user_id", "id");
    }

    public function photos(){
        return $this->hasMany("Azizner\Photo", "user_id", "id");
    }

    public function places(){
        return $this->hasMany("Azizner\Place", "user_id", "id");
    }

    public function hasNewMessage(){

        if($this->incomingMSG()->where('is_read', false)->first()){
            return true;
        }
        return false;
    }

    public function hasNewNotification(){

        if($this->notifications()->where('is_read', false)->first()){
            return true;
        }
        return false;
    }


    public function totalFavorites(){
        return $this->favoriteAnnouncements()->count() + $this->favoritePhotos()->count() + $this->favoritePlaces()->count();
    }

    public function totalAnnouncements(){
        return $this->announcements()->count();
    }

    public function totalNotes(){
        return $this->notes()->count();
    }

    public function totalPhotos(){
        return $this->photos()->count();
    }

    public function totalPlaces(){
        return $this->places()->count();
    }

    public function totalPosts(){
        if($this->is_blogger){
            if($this->blog->posts()->first()){
                return $this->blog->posts->count();
            }
        }

        return 0;
    }


    public function favoriteAnnouncements(){
        return $this->belongsToMany("Azizner\Announcement", "favorite_announcements");
    }

    public function favoritePhotos(){
        return $this->belongsToMany("Azizner\Photo", "favorite_photos");
    }

    public function favoritePlaces(){
        return $this->belongsToMany("Azizner\Place", "favorite_places");
    }


    public function isCreator(){
        if(Creator::where('user_id', $this->id)->first()){
            return true;
        }
        return false;
    }

    public function isAdmin(){
        if(Admin::where('user_id', $this->id)->first()){
            return true;
        }
        return false;
    }


}
