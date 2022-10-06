<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use DB;

class TestApiController extends Controller{
    
    public function datauser(Request $request){

        $unix_times = $request->header('X-Request-Time');
        $key        = $request->header('Mitra-API-Key');
        $secret     = $request->header('Mitra-API-Secret');

        $now            = date('Y-m-d H:i:s', strtotime(Carbon::now().'- 30 second'));
        $cv_unix_times  = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s', $unix_times)));

        // dd(Crypt::encrypt($key.$secret.$unix_times));
        $token = Crypt::decrypt(Crypt::encrypt($key.$secret.$unix_times));
        $merge = $key.$secret.$unix_times;

        if($key != null && $secret != null && $token == $merge && ($now > $cv_unix_times) == false ) {
            // code...

            return response([
                'status'    => '1',
                'message'   => 'Data User',
                'data'      => DB::connection('intramitra')->select("SELECT * FROM mst_group")

            ], 200);

        }else{
            return response([
                'status'    => '0',
                'message'   => 'Token expired'

            ], 410);
        }

       
    }
}
