<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    public $timestamps = false;

    protected $fillable = ['user', 'url', 'platforms_id', 'profiles_id'];

    public function stream(){

        return $this->belongsTo('App\Profile', 'profiles_id');

    }
}
