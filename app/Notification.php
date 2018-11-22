<?php

namespace Azizner;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table  = 'notifications';
    protected $fillable = ['user_id', 'from_id', 'text'];

    public function user(){
        return $this->belongsTo("Azizner\User", "user_id", "id");
    }

    public function from(){
        return $this->belongsTo("Azizner\User", "from_id", "id");
    }
}
