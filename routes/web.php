<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();
Auth::routes([
  'register' => false, // Registration Routes...
  'reset' => false, // Password Reset Routes...
  'verify' => false, // Email Verification Routes...
]);

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/', 'Auth\LoginController@login')->name('login');

Route::group(['middleware' => ['CheckLogin']], function () {

    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
});

// TES API
Route::get('/datauser', 'TestApiController@datauser')->name('datauser');



Route::get('/mnj_users', 'UserController@index')->name('mnj_users')->middleware('can:menu_mst_user');
Route::post('/mnj_users/adduser', 'UserController@adduser')->name('adduser')->middleware('can:menu_mst_user');
Route::get('/mnj_users/{id_user}', 'UserController@detailuser')->name('detailuser')->middleware('can:menu_mst_user');
// Route::get('/mnj_users/{id_user}/detailusermenu', 'UserController@detailusermenu')->name('detailusermenu')->middleware('can:menu_mst_user');
Route::get('/mnj_users/g/{groupID}', 'UserController@detailusermenug')->name('detailusermenug')->middleware('can:menu_mst_user');
Route::post('/editUser', 'UserController@editUser')->name('editUser')->middleware('can:menu_mst_user');
Route::post('/editPassword', 'UserController@editPassword')->name('editPassword')->middleware('can:menu_mst_user');
// Route::post('/addnewmenu', 'UserController@addnewmenu')->name('addnewmenu')->middleware('can:menu_mst_user');
Route::post('/editmenuprv', 'UserController@editmenuprv')->name('editmenuprv')->middleware('can:menu_mst_user');
Route::post('/hapusmenuprv/{id_user}', 'UserController@hapusmenuprv')->name('hapusmenuprv')->middleware('can:menu_mst_user');

Route::get('/mnj_grup', 'UserController@index_grup')->name('mnj_grup')->middleware('can:menu_mst_user');
Route::get('/mnj_grup/datamenu', 'UserController@datamenu')->middleware('can:menu_mst_user');
Route::post('/mnj_grup/addnewgroup', 'UserController@addnewgroup')->name('addnewgroup')->middleware('can:menu_mst_user');
Route::get('/mnj_grup/detailgroup/{id_group}', 'UserController@detailgroup')->name('detailgroup')->middleware('can:menu_mst_user');
Route::post('/mnj_grup/hapusmenugrp', 'UserController@hapusmenugrp')->name('hapusmenugrp')->middleware('can:menu_mst_user');
Route::get('/mnj_grup/detailgroup/add/{id_user}', 'UserController@detailaddmenugrp')->name('detailaddmenugrp')->middleware('can:menu_mst_user');
Route::post('/addnewmenugrp', 'UserController@addnewmenugrp')->name('addnewmenugrp')->middleware('can:menu_mst_user');
Route::post('/editGrup', 'UserController@editGrup')->name('editGrup')->middleware('can:menu_mst_user');



Route::get('/kontrolbank', 'HomeController@kontrolbank')->name('kontrolbank')->middleware('can:menu_kontrol_bank');



Route::get('/report', 'HomeController@report')->name('report')->middleware('can:menu_report_CRM001');
