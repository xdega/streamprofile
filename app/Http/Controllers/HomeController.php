<?php

namespace App\Http\Controllers;

use Auth;
use App\Profile;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        return view('home');

    }

    public function dashboard(){

        $profile = new Profile;

        $hasProfile = $profile->exists( Auth::id() );
        $profileID  = $profile->userIDtoProfileID( Auth::id() );

        $data = array(
            'hasProfile'    =>  $hasProfile,
            'profileID'     =>  $profileID  
        );

        return view('dashboard')->with($data);

    }

}
