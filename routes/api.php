<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['auth:sanctum']],function(){
    Route::get('/getUsers', function (){
        return 'true';
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/opfw/{cid}',function (Request $request, $cid){
    return json_decode(Http::withToken(env("OP_FW_API_KEY"))->get(env("OP_FW_REST_URI") . '/characters/id='.$cid.'/data'))->data[0];
});
