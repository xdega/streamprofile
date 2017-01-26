<?php

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/dashboard', 'HomeController@dashboard')->middleware('auth');

Route::get('/logout', function(){

    Auth::logout();
    
    return redirect()->action('HomeController@index');

});

Route::get('profiles/', function(){

    return view('errors.404');

});

Route::get('profiles/{display_name}', function(App\Profile $display_name){
    $data = array(
        'display_name' => $display_name['display_name']
    );

    return view('profile')->with($data);

});