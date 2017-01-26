<?php

namespace App\Http\Controllers;

use App\Platform;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiPlatformsController extends Controller
{

    
    public function index(){

        return Platform::all();

    }
    

    public function store(Request $request){

        return Platform::create($request->all());

    }

    
    public function show($id){

        return Platform::find($id)->with('user')->get();

    }
    

    
    public function update(Request $request, $id){

        Platform::findOrFail($id)->update($request->all());

        return Platform::json($request->all()); //response()->json()

    }
    

    
    public function destroy($id){

        return Platform::destroy($id);
        
    }
    
}