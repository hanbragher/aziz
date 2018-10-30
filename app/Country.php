<?php

namespace Azizner;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table  = 'countries';
    public $timestamps = false;
    protected $fillable = ['name'];

    public function regions(){
        return $this->belongsTo("Azizner\Region", "id", "country_id");
    }
}
