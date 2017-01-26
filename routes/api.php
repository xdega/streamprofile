<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//PUBLIC ROUTES
Route::get('profiles/u/{display_name}', function($display_name){
    
    $profile_info = App\Profile::where('display_name', '=', $display_name)
                    ->select(['id','display_name','avatar','about'])->get();

    $stream_info  = App\Stream::where('profiles_id', '=', $profile_info[0]->id)->get();

    $profile_data = array(
        'profile_info'  => $profile_info,
        'stream_info'   => $stream_info
    );

    return $profile_data;

});

//PRIVATE ROUTES
Route::get('profiles/id/{id}', function($id){
    
    $profile_info = App\Profile::where('users_id', '=', $id)
                  ->with('user')->get();

    $stream_info  = App\Stream::where('profiles_id', '=', $profile_info[0]->id)->get();

    $profile_data = array(
        'profile_info'  => $profile_info,
        'stream_info'   => $stream_info
    );

    return $profile_data;

});//TODO JWT Auth


Route::get('/profile_id/{user_id}', function($user_id){

    $result = App\Profile::where('users_id', '=', $user_id)->select('id')->get();

    isset( $result[0]->id ) ? $result = $result[0]->id : $result[0] = false ;

    return $result;

});//TODO: JWT Auth


//Resource Routes
Route::resource('/profiles', 'ApiProfilesController');
Route::resource('/streams', 'ApiStreamsController');
Route::resource('/platforms', 'ApiPlatformsController');