<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Api;
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
	$newResponse = new Api();
	$newResponse->from = $req->from;
	$newResponse->to = $req->to;
	$newResponse->subject = $req->subject;
	$newResponse->html = $req->html;
	$newResponse->save();
	return $req->all();
});


// coba coba
Route::post('/coba',function(Request $req){
	return $req->all();
});