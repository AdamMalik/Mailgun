<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
// use Mailgun\Mailgun;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/message',function(Request $req){
	// return response()->json(['status'=>'success', 'message'=>'hohohoho']);
	return $req->all();
});


// coba coba
Route::post('/store',function(Request $req){
	$contents = Storage::get('file.txt');
	Storage::put('file.txt',  json_encode($req->all())."\n". $contents );
	$contents = Storage::get('file.txt');
	return $contents;
});
// Route::post('/create/{email}/{name}/{password}',function(Request $req, $email, $name, $password){
	// return $req->all();
// 	DB::table('users')->insert(
// 	    ['name'=>$name, 'email' => $email, 'password' => bcrypt($password) ]
// 	);
// 	return 'gotcha';
// });
// Route::post('/send/{to_user}/{subject}/{message}',function(Request $req, $to_user, $subject, $message){
	// return $req->all();
	// $mgClient = new Mailgun('key-30f568b1ba8dcd818cb866c7d9860541');
	// $domain = "mail.ingo.io";

	# Make the call to the client.
	// return $sent;
	// $result = $mgClient->sendMessage("$domain", array(
	//     'from'    => 'admin@ingo.com',
	//     'to'      => $to_user,
	//     'subject' => $subject,
	//     'html'    => $message
	// ));

	// return json_encode($result);
// });