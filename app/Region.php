<?php

namespace Azizner;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table  = 'regions';
    public $timestamps = false;
    protected $fillable = ['name', 'country_id'];

    public function country(){
        return $this->hasOne("Azizner\Country", "id", "country_id");
    }
}
