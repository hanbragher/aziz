<?php

namespace Azizner;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table  = 'admins';
    protected $fillable = ['user_id'];

    public function user(){
        return $this->belongsTo("Azizner\User", "user_id", "id");
    }
}
