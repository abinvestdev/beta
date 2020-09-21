<?php

namespace App\Http\Controllers;
use Auth;
use Session;
use DB;

use Illuminate\Http\Request;

class LoginCustom extends Controller
{
     public function login(Request $request) {


     	    if(!Auth::attempt(['email'=>$request->email,'password'=>$request->password])) {
     	    	echo 'failed';
     	    }else{
     	    	echo 'Login';
     	    }



     }
}
