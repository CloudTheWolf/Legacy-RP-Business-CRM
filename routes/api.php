<?php

use App\Http\Controllers\Api\VersionOne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/opfw/{cid}',function (Request $request, $cid){
    return Http::withoutVerifying()->withToken(env("OP_FW_API_KEY"))->withoutVerifying()->get(env("OP_FW_REST_URI") . '/characters/id='.$cid.'/data')->json()['data'][0];
});

Route::prefix('/v1')->group(function (){
    Route::get('ActiveUsers',[VersionOne::class,'GetAllActiveUsers']);
    if (config('app.siteMode') == "Mechanic") {
        Route::prefix('/mechanic')->group(function () {
        });
    }
});
