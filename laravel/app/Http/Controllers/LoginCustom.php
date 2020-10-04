<?php

namespace App\Http\Controllers;
use Auth;
use Session;
use DB;

use Illuminate\Http\Request;

class LoginCustom extends Controller
{
     public function login(Request $request) {


     	    if(!Auth::attempt(['email'=>$request->email,'password'=>$request->password,'user_status'=>'Active'])) {
     	    	$data['status'] = 'failed';
     	    	$data['mesg'] = 'Login failed';
     	    }else{
     	    	$data['status'] = 'success';
     	    	$data['mesg'] = 'Successfully Logged in';
     	    }
     	    return json_encode($data);



     }
}
