<?php

namespace Azizner;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table  = 'cities';
    public $timestamps = false;
    protected $fillable = ['name', 'region_id'];

    public function region(){
        return $this->hasOne("Azizner\Region", "id", "region_id");
    }
}
