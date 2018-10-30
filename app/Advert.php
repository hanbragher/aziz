<?php

namespace Azizner;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    protected $table  = 'adverts';
    protected $fillable = ['title', 'text', 'user_id', 'main_image'];
}
