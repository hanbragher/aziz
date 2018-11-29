<?php

namespace Azizner;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table  = 'notes';
    protected $fillable = ['user_id', 'place_id', 'text'];

}
