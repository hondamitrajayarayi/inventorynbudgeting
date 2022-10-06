<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller{

   public function index(){
      
      $id = Auth::user()->username;
      $grup = DB::connection('intramitra')->select("SELECT * FROM mst_group");
           
      if (request()->ajax()) {

            $data = DB::connection('intramitra')->select("SELECT * FROM mst_user usr LEFT JOIN mst_group grp ON grp.GROUP_ID = usr.GROUP_ID");
            // dd($data);
                
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status', function($row){
                     // dd($row);
                        $stts = '<i class="mdi mdi-'. ($row->user_status == 1 ? 'check-circle' : 'close-circle') .'" style="color:'. ($row->user_status == 1 ? '#81B214;' : 'red;') .' font-size:15px"></i>'. ($row->user_status == 1 ? ' Aktif' : ' Tidak Aktif') .'';
                        

                        return $stts;
                    }) 
                    ->rawColumns(['status'])
                    ->make(true);
      }

      return view('user.index', compact('grup'));
   }

   public function adduser(Request $request){
      $id = Auth::user()->username;

      $newdatao [] = [
         'user_id'      => $request->username,
         'user_descr'   => $request->nama,
         'user_password'=> Hash::make($request->password),
         'user_status'  => 1,
         'group_id'     => $request->group,
         'create_user'  => $id,
         'create_date'  => Carbon::now(),
         'last_user'    => $id,
         'branch_id'    => $request->cabang,
      ];

      $newdatas [] = [
         'name'   => $request->nama,
         'username'=> $request->username,
         'password'=> Hash::make($request->password),
         'status'  => 1
      ];
      // dd($newdatas);

      DB::connection('intramitra')->table('mst_user')->insert($newdatao);
      DB::connection('mysql')->table('users')->insert($newdatas);

       
      return response()->json([
         'success' => true,
         'message' => 'Menu Berhasil Ditambah !',
      ]);
      
   }

   public function detailuser($id_user){
       $data = DB::connection('intramitra')->select("SELECT * FROM mst_user where user_id = '$id_user'");
       $datagrp = DB::connection('intramitra')->select("SELECT * FROM mst_group");
       $idgrp = DB::connection('intramitra')->select("SELECT grp.group_id FROM mst_group grp left join mst_user usr on usr.group_id = grp.group_id where usr.user_id = '$id_user'");

       foreach ($idgrp as $key) {
          $group_id = $key->group_id;
       }
       // dd($group_id);
       $userID = $id_user;
      
      if (request()->ajax()) {

         $prv = DB::connection('intramitra')->select("SELECT grp.group_id, grp.group_name, mnu.menu_name, mnu.menu, mnu.status as status_menu, mnu.menu_id, prv.status  FROM MST_USER_PRV prv LEFT JOIN mst_menu mnu ON MNU.MENU_ID = PRV.MENU_ID LEFT JOIN mst_user usr ON USR.USER_ID = PRV.USER_ID LEFT JOIN mst_group grp ON GRP.GROUP_ID = PRV.GROUP_ID where usr.user_id = '$id_user' order by grp.group_name asc");

         return Datatables::of($prv)
              ->addIndexColumn()
              ->addColumn('menu', function($row){

                 $menu = ''. $row->group_name .' | '.$row->menu_name.' | '.$row->menu.'';

                  return $menu;
              })
              ->addColumn('desc', function($row){

                 $desc = ''.$row->menu.'';

                  return $desc;
              })
              ->addColumn('izin', function($row){

                 $izin = '<div class="custom-control custom-checkbox mb-3">
                 <input type="checkbox" class="custom-control-input selectprv" name="izinprv[]" value="'.$row->menu_id.'" id="customCheck1-'. $row->menu_id .'-'.$row->group_id.'" '.( $row->status == 1 ? 'checked' : '' ).'>
                 <label class="custom-control-label" for="customCheck1-'. $row->menu_id .'-'.$row->group_id.'"></label></div>';

                  return $izin;
              })
              ->addColumn('status_menu', function($row){
                  // dd($row);
                  $status_menu = '<i class="mdi mdi-'. ($row->status_menu == 1 ? 'check-circle' : 'close-circle') .'" style="color:'. ($row->status_menu == 1 ? '#81B214;' : 'red;') .' font-size:15px"></i>'. ($row->status_menu == 1 ? ' Aktif' : ' Tidak Aktif') .'';
                 

                  return $status_menu;
              })
              ->rawColumns(['menu','izin','status_menu','desc'])
              ->make(true);
      }
      // dd($datagrp);
      return view('user.detailuser', compact('data','userID','datagrp','group_id'));
   }

   public function detailusermenug(Request $request){
      $groupID = $request->grupID;
      $userID = $request->userID;

      if (request()->ajax()) {

         $prv = DB::connection('intramitra')->select("SELECT grp.group_id, grp.group_name, mnu.menu_name, mnu.menu, mnu.status as status_menu, mnu.menu_id, prv.status  FROM MST_USER_PRV prv LEFT JOIN mst_menu mnu ON MNU.MENU_ID = PRV.MENU_ID LEFT JOIN mst_user usr ON USR.USER_ID = PRV.USER_ID LEFT JOIN mst_group grp ON GRP.GROUP_ID = PRV.GROUP_ID where grp.group_id = '$groupID' and usr.user_id = '$userID' order by grp.group_name asc");

         if (count($prv) < 1) {
            $prv = DB::connection('intramitra')->select("SELECT '0' as Status, grp.group_id, grp.group_name, mnu.menu_name, mnu.menu, mnu.status as status_menu, mnu.menu_id  FROM mst_group_privilage prv LEFT JOIN mst_menu mnu ON MNU.MENU_ID = PRV.MENU_ID LEFT JOIN mst_group grp ON GRP.GROUP_ID = PRV.GROUP_ID where grp.group_id = '$groupID' order by grp.group_name asc");
         }

         return Datatables::of($prv)
              ->addIndexColumn()
              ->addColumn('menu', function($row){

                 $menu = ''. $row->group_name .' | '.$row->menu_name.'';

                  return $menu;
              })
              ->addColumn('desc', function($row){

                 $desc = ''.$row->menu.'';

                  return $desc;
              })
              ->addColumn('izin', function($row){

                 $izin = '<div class="custom-control custom-checkbox mb-3">
                 <input type="checkbox" class="custom-control-input selectprv" name="izinprv[]" value="'.$row->menu_id.'" id="customCheck1-'. $row->menu_id .'-'.$row->group_id.'" '.( $row->status == 1  ? 'checked' : '' ).'>
                 <label class="custom-control-label" for="customCheck1-'. $row->menu_id .'-'.$row->group_id.'"></label></div>';

                  return $izin;
              })
              ->addColumn('status_menu', function($row){
                  // dd($row);
                  $status_menu = '<i class="mdi mdi-'. ($row->status_menu == 1 ? 'check-circle' : 'close-circle') .'" style="color:'. ($row->status_menu == 1 ? '#81B214;' : 'red;') .' font-size:15px"></i>'. ($row->status_menu == 1 ? ' Aktif' : ' Tidak Aktif') .'';
                 

                  return $status_menu;
              })
              ->rawColumns(['menu','izin','status_menu','desc'])
              ->make(true);
      }
      
   }

   public function editUser(Request $request){
      $databaru = [
         'user_descr'   => $request->name,
         'user_status'  => $request->status
      ];

      $databaru2 = [
         'name'   => $request->name,
         'status'  => $request->status
      ];

      $update = DB::connection('intramitra')->table('mst_user')->where('user_id', $request->user_id)->update($databaru);
      DB::connection('mysql')->table('users')->where('username', $request->user_id)->update($databaru2);

      if ($update) {   
         return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diubah !',
         ]);
      }else{
         return response()->json([
            'success' => false
         ]);
      }
   }

   public function editPassword(Request $request){
      $id = $request->userID;
      $psswd = Hash::make($request->psswd);
     
      DB::connection('mysql')->update("UPDATE users SET password='$psswd' WHERE username = '$id'");
      $update = DB::connection('intramitra')->update("UPDATE mst_user SET user_password='$psswd' WHERE user_id = '$id'");
      
      if ($update) {   
         return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diubah !',
         ]);
      }else{
         return response()->json([
            'success' => false
         ]);
      }
   }

   public function editmenuprv(Request $request){
      $menuid = [];
      $addmenuaktif = [];

      $userlogin = Auth::user()->username;

      $id = $request->userID;
      $menuid = $request->izinprv;
      $addmenuaktif = $request->izinprvC;
      $newgroup_user = $request->group_usr;

      $cekgrp = DB::connection('intramitra')->select("SELECT * from mst_user where user_id = '$id'");
      foreach ($cekgrp as $grp) {
         $grpcek = $grp->group_id;
      }
        
      if ($grpcek != $newgroup_user) {
         // code...
         // dd($grp->group_id , $newgroup_user, 'beda');
         // update status mst_user
         DB::connection('intramitra')->update("UPDATE MST_USER SET group_id='$newgroup_user' WHERE user_id='$id'");
         // delete by user id mstuser privilage
         DB::connection('intramitra')->delete("DELETE FROM MST_USER_prv WHERE user_id='$id'");
         // insert new privilage
         
         if (!is_null($addmenuaktif)) {
            // dd($addmenuaktif);
            foreach ($addmenuaktif as $menu) {

            
               $addPrvMenu[] = [
                  'user_id'      => $id, 
                  'group_id'     => $newgroup_user, 
                  'menu_id'      => $menu, 
                  'create_user'  => $userlogin, 
                  'create_date'  => Carbon::now(), 
                  'last_user'    => $userlogin, 
                  'last_update'  => Carbon::now(), 
                  'status'       => 1, 
               ];

            }
            // dd($addPrvMenu);
            DB::connection('intramitra')->table('MST_USER_PRV')->insert($addPrvMenu);

            
         }

         if (!is_null($menuid)) {
            foreach ($menuid as $menu) {

               $addPrvMenu2[] = [
                  'user_id'      => $id, 
                  'group_id'     => $newgroup_user, 
                  'menu_id'      => $menu, 
                  'create_user'  => $userlogin, 
                  'create_date'  => Carbon::now(), 
                  'last_user'    => $userlogin, 
                  'last_update'  => Carbon::now(), 
                  'status'       => 0, 
               ];

            }
            DB::connection('intramitra')->table('MST_USER_PRV')->insert($addPrvMenu2);

            
         }

         return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diubah !',
         ]);


      }else{
         // dd($grp->group_id , $newgroup_user,'sama');
         if (!is_null($menuid)) {
            foreach ($menuid as $menu) {
               DB::connection('intramitra')->update("UPDATE MST_USER_PRV SET status='0' WHERE user_id='$id' and menu_id = '$menu'");
            }
         }

         if (!is_null($addmenuaktif)) {
            foreach ($addmenuaktif as $menuadd) {
           
               DB::connection('intramitra')->update("UPDATE MST_USER_PRV SET status='1' WHERE user_id='$id' and menu_id = '$menuadd'");
            }
         }

         return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diubah !',
         ]);
      } //end else      
      
   }

   public function index_grup(){
           
      if (request()->ajax()) {

            $data = DB::connection('intramitra')->select("SELECT * FROM mst_group");
               // dd($data); 
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status', function($row){
                     // dd($row);
                     $stts = '<i class="mdi mdi-'. ($row->status == 1 ? 'check-circle' : 'close-circle') .'" style="color:'. ($row->status == 1 ? '#81B214;' : 'red;') .' font-size:15px"></i>'. ($row->status == 1 ? ' Aktif' : ' Tidak Aktif') .'';
                        

                        return $stts;
                    }) 
                    ->rawColumns(['status'])
                    ->make(true);
      }

      return view('user.index_grup');
   }

   public function datamenu(){

         $menu = DB::connection('intramitra')->select("SELECT * FROM mst_menu");

         return Datatables::of($menu)
              ->addIndexColumn()
              ->addColumn('check', function($row){

                 $chckls = '<div class="custom-control custom-checkbox mb-3"><input type="checkbox" class="custom-control-input selectaddmenu" name="menuID[]" id="customCheck1-'.$row->menu_id.'" value="'.$row->menu_id.'" }}><label class="custom-control-label" for="customCheck1-'.$row->menu_id.'"></label></div>';

                  return $chckls;
              })
              ->addColumn('status_menu', function($row){
                  
                  $status_menu = '<i class="mdi mdi-'. ($row->status == 1 ? 'check-circle' : 'close-circle') .'" style="color:'. ($row->status == 1 ? '#81B214;' : 'red;') .' font-size:15px"></i>'. ($row->status == 1 ? ' Aktif' : ' Tidak Aktif') .'';
                 

                  return $status_menu;
              })
             
              ->rawColumns(['check','status_menu'])
              ->make(true);
      
   }

   public function addnewgroup(Request $request){
      // dd($request);
      $menuid = $request->menu_id;
      $userlogin = Auth::user()->username;

      $grup = DB::connection('intramitra')->select("SELECT max(group_id) as group_id FROM mst_group");
      foreach ($grup as $key) {
       
         $id = $key->group_id;
         $urutan = (int) substr($id, 4, 4);

         $groupid = "GRP-" . sprintf("%04s", $urutan+1);

      }


      $addGroup = [
         'group_id'   => $groupid,
         'group_name' => $request->group_name,
         'group_descr'=> $request->group_descr,
         'status'     => 1,
         'create_user'=> $userlogin,
         'create_date'=> Carbon::now(),
         'last_user'  => $userlogin,
         'last_update'=> Carbon::now(),
      ];


      foreach ($menuid as $menu) {

         $addprvGROUP[] = [
            'group_id'     => $groupid, 
            'menu_id'      => $menu, 
            'create_user'  => $userlogin, 
            'create_date'  => Carbon::now(), 
            'last_user'    => $userlogin, 
            'last_update'  => Carbon::now()
         ];
      }

      DB::connection('intramitra')->table('mst_group_privilage')->insert($addprvGROUP);
      $ADD = DB::connection('intramitra')->table('mst_group')->insert($addGroup);

      if ($ADD) {   
         return response()->json([
            'success' => true,
            'message' => 'group prv Berhasil Ditambah !',
         ]);
      }else{
         return response()->json([
            'success' => false
         ]);
      }
   }

   public function detailgroup($id_group){
      // dd($id_group);
      $data = DB::connection('intramitra')->select("SELECT * FROM mst_group where group_id = '$id_group'");

      if (request()->ajax()) {
         
         $prv = DB::connection('intramitra')->select("SELECT prv.group_id, mnu.menu_id as menu_id, mnu.status as status_menu, mnu.menu FROM mst_group grp
         LEFT JOIN mst_group_privilage prv ON prv.GROUP_ID = grp.GROUP_ID LEFT JOIN mst_menu mnu ON mnu.menu_id = prv.menu_id WHERE grp.GROUP_ID = '$id_group' ORDER BY grp.group_name ASC");

         return Datatables::of($prv)
              ->addIndexColumn()
              ->addColumn('menu', function($row){

                  $menu = ''.$row->menu.'';

                  return $menu;
              })
              ->addColumn('status_menu', function($row){
                  // dd($row);
                  $status_menu = '<i class="mdi mdi-'. ($row->status_menu == 1 ? 'check-circle' : 'close-circle') .'" style="color:'. ($row->status_menu == 1 ? '#81B214;' : 'red;') .' font-size:15px"></i>'. ($row->status_menu == 1 ? ' Aktif' : ' Tidak Aktif') .'';
                 

                  return $status_menu;
              })
              ->addColumn('hapus', function($row){
                  // dd($row); '.$row->menu_id.'
                  $hapus = '<button type="button" class="btn btn-danger btn-sm" onclick="hapus(\''.$row->menu_id.'\')"><i class="fa fa-trash"></i> Hapus</button>';                 

                  return $hapus;
              })
              ->rawColumns(['menu','status_menu','hapus'])
              ->make(true);
      }

      return view('user.detailgroup', compact('data','id_group'));
   }

   public function hapusmenugrp(Request $request){
      $group_id = $request->id_group;
      $menu_id = $request->menu_id;

      DB::connection('intramitra')->delete("DELETE FROM mst_group_privilage WHERE group_id='$group_id' and menu_id ='$menu_id'");

      // delete di prv user
      DB::connection('intramitra')->delete("DELETE FROM mst_user_prv WHERE group_id='$group_id' and menu_id ='$menu_id'");

      return response()->json([
         'success' => true,
         'message' => 'Data Berhasil Dihapus !',
      ]);
   }

   public function detailaddmenugrp($id_group){

         $menu = DB::connection('intramitra')->select("SELECT * FROM mst_menu where menu_id not in (select menu_id from mst_group_privilage where group_id ='$id_group')");

         return Datatables::of($menu)
              ->addIndexColumn()
              ->addColumn('check', function($row){

                 $chckls = '<div class="custom-control custom-checkbox mb-3"><input type="checkbox" class="custom-control-input selectaddmenu" name="menuID[]" id="customCheck1-'.$row->menu_id.'" value="'.$row->menu_id.'" }}><label class="custom-control-label" for="customCheck1-'.$row->menu_id.'"></label></div>';

                  return $chckls;
              })
              ->addColumn('status_menu', function($row){
                  
                  $status_menu = '<i class="mdi mdi-'. ($row->status == 1 ? 'check-circle' : 'close-circle') .'" style="color:'. ($row->status == 1 ? '#81B214;' : 'red;') .' font-size:15px"></i>'. ($row->status == 1 ? ' Aktif' : ' Tidak Aktif') .'';
                 

                  return $status_menu;
              })
             
              ->rawColumns(['check','status_menu'])
              ->make(true);
      
   }

   public function addnewmenugrp(Request $request){
      $group_id = $request->id_group;
      $menuid = $request->menu_id;
      $userlogin = Auth::user()->username;
      $addPrvMenu = [];
      $addPrvgrv = [];

      $data = DB::connection('intramitra')->select("SELECT user_id from mst_user where group_id = '$group_id'");
      foreach ($menuid as $menu) {

         foreach ($data as $result) {
            $user_id = $result->user_id;
            $addPrvMenu[] = [
               'user_id'      => $user_id, 
               'group_id'     => $group_id, 
               'menu_id'      => $menu, 
               'create_user'  => $userlogin, 
               'create_date'  => Carbon::now(), 
               'last_user'    => $userlogin, 
               'last_update'  => Carbon::now(), 
               'status'       => 0, 
            ];
         }

         $addPrvgrp[] = [
               'group_id'     => $group_id, 
               'menu_id'      => $menu, 
               'create_user'  => $userlogin, 
               'create_date'  => Carbon::now(), 
               'last_user'    => $userlogin, 
               'last_update'  => Carbon::now(), 
            ];

      }
      // dd($addPrvMenu, $addPrvgrp);
      $update = DB::connection('intramitra')->table('MST_USER_PRV')->insert($addPrvMenu);
      DB::connection('intramitra')->table('mst_group_privilage')->insert($addPrvgrp);

      if ($update) {   
         return response()->json([
            'success' => true,
            'message' => 'Menu Berhasil Ditambah !',
         ]);
      }else{
         return response()->json([
            'success' => false
         ]);
      }
   }

   public function editGrup(Request $request){
      $databaru = [
         'group_name'   => $request->group_name,
         'group_descr'  => $request->group_descr,
         'status'  => $request->status
      ];

      $update = DB::connection('intramitra')->table('mst_group')->where('group_id', $request->group_id)->update($databaru);

      if ($update) {   
         return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diubah !',
         ]);
      }else{
         return response()->json([
            'success' => false
         ]);
      }
   }
}
