<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class BettingController extends Controller
{
    //

    public function index(){

       return view('bitcoin');
    }
    public function bitmex()
    {
        return view('bitmex');
    }
    public function binance()
    {
        return view('binance');
    }
    public function addCart(Request $req){
        $data = $req->input();

        $post['user_id']         = Auth::user()->id;
        $rounds = 0;
        for($i=0;$i<count($data['round_bet']);$i++){
            if($data['round_bet'][$i] != 0 && $data['round_bet'][$i] != ''){
                $rounds++;
                $starting_amount[] = $data['starting_amount'][$i];
                $round_bet[] = $data['round_bet'][$i];
            }
        }
        $post['starting_amount'] = json_encode($starting_amount);
        $post['round_bet']       = json_encode($round_bet);

        $post['rounds']        = $rounds;
        $post['round_results'] = 0;
        $post['ending_amount'] = 0;
        $post['bet_val']       = 0;

        
        DB::table('binance_bet')->insert($post);

    }
    

}
