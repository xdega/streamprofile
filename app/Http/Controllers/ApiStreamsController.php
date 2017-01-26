<?php

namespace App\Http\Controllers;

use App\Stream;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiStreamsController extends Controller
{

    
    public function index(){

        return Stream::all();

    }
    

    public function store(Request $request){

        //Custom Validation Messages
        $messages = [
            'platforms_id.required' => 'Please Select a Platform!',
        ];

        //Validation Logic
        $this->validate($request, [
            'platforms_id' => 'required',
            'user' => 'required|max:255'
        ], $messages);
        
        return Stream::create($request->all());

    }

    
    public function show($id){

        return Stream::find($id)->with('user')->get();

    }
    

    
    public function update(Request $request, $id){

        Stream::findOrFail($id)->update($request->all());

        return Stream::json($request->all()); //response()->json()

    }
    

    
    public function destroy($id){

        return Stream::destroy($id);
        
    }
    
}