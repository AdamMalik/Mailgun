<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
// require 'vendor/autoload.php';
// use Bogardo\Mailgun\Facades\Mailgun;

// require 'vendor/autoload.php';
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

// Route::get('/', function (Request $req) {
// 	$value = $req->session()->get('msg','null');
//     return view('login',['msg'=>$value]);
// });
Auth::routes();

Route::group(['middleware' => ['auth']], function(){
	Route::get('/', 'user@index');
	Route::get('/register','user@index');
	Route::get('/forward/{id}','user@forward');
	Route::get('/mail/{page}','user@getMail');
	Route::get('/draft/{page}','user@getDraft');
	Route::get('/read-mail/{id}','user@readMail');
	Route::get('/read-sent/{id}','user@readMail');
	Route::get('/read-draft/{id}','user@readMail');
	Route::get('/compose-draft/{id}','user@composeDraft');
	Route::get('/sent/{page}','user@getSent');
	Route::get('/search-sent/{cari?}/{page?}','user@search');
	Route::get('/search-draft/{cari?}/{page?}','user@search');
	Route::get('/search-mail/{cari?}/{page?}','user@search');
	Route::get('/delete-message/{id}','user@deleteMessage');
	Route::match(['get','post'],'/compose/{email?}','user@compose');
	Route::post('/draft','user@postDraft');
});
Route::group(['middleware' => ['admin','auth']], function(){
	Route::get('/user/{page}','admin@user');
	Route::post('/delete/{id}','admin@deleteUser');
	Route::post('/add-user','admin@add');
	Route::post('/edit-user','admin@editUser');	
});