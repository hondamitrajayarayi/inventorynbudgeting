<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use DB;
use Auth;
use Carbon\Carbon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
        
        $this->registerPolicies();

        Gate::define('menu_mst_user', function (){

            $id = Auth::user()->username;
            $now = Carbon::now();

            $cekMenu = DB::connection('intramitra')->select("SELECT usr.USER_STATUS as sttsUser, mnu.status as sttsMenu, prv.status as sttsprv FROM MST_USER_PRV prv LEFT JOIN mst_menu mnu ON MNU.MENU_ID = PRV.MENU_ID LEFT JOIN mst_user usr ON USR.USER_ID = PRV.USER_ID LEFT JOIN mst_group grp ON GRP.GROUP_ID = PRV.GROUP_ID WHERE usr.user_id = '$id' and mnu.menu_id ='MSTUSER' ");

            foreach($cekMenu as $cek){
                // dd($cek->sttsuser);

                if ($cek->sttsuser == 1 and $cek->sttsmenu == 1 and $cek->sttsprv == 1) {
                    DB::connection('intramitra')->update("UPDATE mst_user SET last_login='$now' WHERE user_id='$id'");
                    return true;

                }
            }
            return false;
        });

        Gate::define('menu_report_CRM001', function (){

            $id = Auth::user()->username;
            $now = Carbon::now();
            $cekMenu = DB::connection('intramitra')->select("SELECT usr.USER_STATUS as sttsuser, mnu.status as sttsmenu, prv.status as sttsprv FROM MST_USER_PRV prv LEFT JOIN mst_menu mnu ON MNU.MENU_ID = PRV.MENU_ID LEFT JOIN mst_user usr ON USR.USER_ID = PRV.USER_ID LEFT JOIN mst_group grp ON GRP.GROUP_ID = PRV.GROUP_ID WHERE usr.user_id = '$id' and mnu.menu_id ='RPT001' ");

            foreach($cekMenu as $cek){
                // dd($cek->sttsuser);

                if ($cek->sttsuser == 1 and $cek->sttsmenu == 1 and $cek->sttsprv == 1) {
                    DB::connection('intramitra')->update("UPDATE mst_user SET last_login='$now' WHERE user_id='$id'");
                    return true;
                }
            }
            return false;
        });

        Gate::define('menu_kontrol_bank', function (){

            $id = Auth::user()->username;
            $now = Carbon::now();
            $cekMenu = DB::connection('intramitra')->select("SELECT usr.USER_STATUS as sttsUser, mnu.status as sttsMenu, prv.status as sttsprv FROM MST_USER_PRV prv LEFT JOIN mst_menu mnu ON MNU.MENU_ID = PRV.MENU_ID LEFT JOIN mst_user usr ON USR.USER_ID = PRV.USER_ID LEFT JOIN mst_group grp ON GRP.GROUP_ID = PRV.GROUP_ID WHERE usr.user_id = '$id' and mnu.menu_id ='CRM001' ");

            foreach($cekMenu as $cek){
                // dd($cek->sttsuser);

                if ($cek->sttsuser == 1 and $cek->sttsmenu == 1 and $cek->sttsprv == 1) {
                    DB::connection('intramitra')->update("UPDATE mst_user SET last_login='$now' WHERE user_id='$id'");
                    return true;
                }
            }
            return false;
        });

        Gate::define('menu_kontrol_bank_2', function (){

            $id = Auth::user()->username;
            $now = Carbon::now();
            $cekMenu = DB::connection('intramitra')->select("SELECT usr.USER_STATUS as sttsUser, mnu.status as sttsMenu, prv.status as sttsprv FROM MST_USER_PRV prv LEFT JOIN mst_menu mnu ON MNU.MENU_ID = PRV.MENU_ID LEFT JOIN mst_user usr ON USR.USER_ID = PRV.USER_ID LEFT JOIN mst_group grp ON GRP.GROUP_ID = PRV.GROUP_ID WHERE usr.user_id = '$id' and mnu.menu_id ='CRM002' ");

            foreach($cekMenu as $cek){
                // dd($cek->sttsuser);

                if ($cek->sttsuser == 1 and $cek->sttsmenu == 1 and $cek->sttsprv == 1) {
                    DB::connection('intramitra')->update("UPDATE mst_user SET last_login='$now' WHERE user_id='$id'");
                    return true;
                }
            }
            return false;
        });
    }
}
