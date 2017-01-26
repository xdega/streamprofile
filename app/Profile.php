<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['display_name', 'avatar', 'about', 'users_id'];

    public function exists($id){

        $result = $this->where('users_id', '=', $id)->exists();

        return $result;

    }

    public function userIDtoProfileID($id){

        $result = $this->where('users_id', '=' ,$id)->pluck('id');
        
        //First Result Only. If any.
        isset( $result[0] ) ? $result = $result[0] : $result[0] = false ;

        return $result;
    }

    public function user(){

        return $this->belongsTo('App\User', 'users_id')
                ->select(['id', 'username', 'email']);

    }

    public function getRouteKeyName(){

        return 'display_name';

    }
}