<?php

namespace Azizner;

use Illuminate\Database\Eloquent\Model;

class Creator extends Model
{
    protected $table  = 'creators';
    protected $fillable = ['user_id'];
    public $timestamps = false;

    public function user(){
        return $this->belongsTo("Azizner\User", "user_id", "id");
    }
}
