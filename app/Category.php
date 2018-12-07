<?php

namespace Azizner;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table  = 'categories';
    public $timestamps = false;
    protected $fillable = ['name', 'image'];


}
