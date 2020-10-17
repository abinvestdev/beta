<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class UserController extends Controller
{
    
       public function deposit(Request $request){

        $data['user_id'] = Auth::user()->id;
        $data['amount'] = $request->input('deposit_amount');
        $data['transaction_type'] = 1;
        $data['transaction_date'] = date('Y-m-d H:i:s');
        $data['description'] = '';
        $data['transaction_status'] = '';
        DB::table('money_transaction')->insert($data);
        $ret['status'] = 'success';
        $ret['mesg']   = 'Successully submitted';
        return json_encode($ret);

       }
       public function withdraw(Request $request){
        $data['user_id'] = Auth::user()->id;
        $data['amount'] = $request->input('withdrawal_amount');
        $data['transaction_type'] = 2;
        $data['transaction_date'] = date('Y-m-d H:i:s');
        $data['description'] = '';
        DB::table('money_transaction')->insert($data);
        $ret['status'] = 'success';
        $ret['mesg']   = 'Successully submitted';
        return json_encode($ret);


       }
       public function register(Request $request){

        $ifExist = DB::table('users')->where('email',$request->email)->count();
        $error = 0;
        if($ifExist > 0){
            $error++;
            $return['status'] = 'failed';
            $return['mesg']   = 'Sorry this user is already exists.';
        }
        $checkinput = $request->input();
       
        foreach($checkinput as $row=>$a){
            if($request->$row == ''){
                $error++;
                $return['status'] = 'failed';
                $return['mesg']   = 'Please fill all the fields.';
            }
        }

        if($error == 0){
            $return['status'] = 'success';
            $return['mesg'] = 'Successfully Registered';
            unset($checkinput['_token']);
            $checkinput['password'] = bcrypt($checkinput['password']);
            $checkinput['created_at'] = date('Y-m-d H:i:s');
    
             DB::table('users')->insert($checkinput);

        }
        return json_encode($return);


    }
}
