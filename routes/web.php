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
	Route::get('/mail/{page}','user@getMail');
	Route::get('/draft/{page}','user@getDraft');
	Route::get('/read-mail/{id}','user@readMail');
	Route::get('/read-sent/{id}','user@readMail');
	Route::get('/read-draft/{id}','user@readDraft');
	Route::get('/compose-draft/{id}','user@composeDraft');
	Route::get('/sent/{page}','user@getSent');
	Route::match(['get','post'],'/compose','user@compose');
	Route::post('/draft','user@postDraft');
});
Route::group(['middleware' => ['admin','auth']], function(){
	Route::get('/user/{page}','admin@user');
	Route::get('/delete/{id}','admin@deleteUser');
	Route::post('/add-user','admin@add');
	Route::post('/edit-user','admin@editUser');	
});

// Coba - coba
// Route::get('/getmessage',function(Request $req){
// 	return $req->all();
// });
// Route::get('/api',function(Request $req){
// 	return Redirect::to('https://key-30f568b1ba8dcd818cb866c7d9860541@api.mailgun.net/v3/mail.ingo.io/log');
// });