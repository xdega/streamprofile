<?php

namespace App\Http\Controllers;

use Validator;
use App\Profile;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiProfilesController extends Controller
{

    
    public function index(){

        //$result = Profile::all()
            //->select(['id','display_name','avatar','about'])->get();

        //return $result;
        return Profile::all();

    }
    

    public function store(Request $request){

        $rules = array(
            'avatar'        => array('url', 'regex:~^https?://(?:[a-z0-9\-]+\.)+[a-z]{2,6}(?:/[^/#?]+)+\.(?:jpe?g|gif|png)$~'),
            'about'         => array('string', 'max:1000' ),
            'display_name'  => array('required','min:3','unique:profiles','alpha_dash','max:255')
        );

        $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {

                return response()->json( $validator->errors() )
                ->setStatusCode(422, 'Unprocessable Entity');

            }

            /*
            $image_headers = @get_headers($request->avatar);

            if(!$image_headers || $image_headers[0] == 'HTTP/1.1 404 Not Found'   ) {

                $response = array(
                    'avatar' => array('The avatar URL is broken.')
                );

                return response()->json( $response )
                ->setStatusCode(422, 'Unprocessable Entity');
            }
            */

        
        return Profile::create($request->all());

    }

    
    public function show($id){

        return Profile::find($id)->with('user')->get();

    }
    

    
    public function update(Request $request, $id){

            $rules = array(
                'avatar' => array('url', 'regex:~^https?://(?:[a-z0-9\-]+\.)+[a-z]{2,6}(?:/[^/#?]+)+\.(?:jpe?g|gif|png)$~'
                ),
                'about'  => array('string', 'max:1000' )
            );

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {

                return response()->json( $validator->errors() )
                ->setStatusCode(422, 'Unprocessable Entity');

            }

            $image_headers = @get_headers($request->avatar);

            if(!$image_headers || $image_headers[0] == 'HTTP/1.1 404 Not Found') {

                $response = array(
                    'avatar' => array('The avatar URL is broken.')
                );

                return response()->json( $response )
                ->setStatusCode(422, 'Unprocessable Entity');
            }

            $edit = Profile::find($id)->update($request->all());

            return response()->json($edit);

    }
    

    
    public function destroy($id){

        return Profile::destroy($id);
        
    }
    
}
