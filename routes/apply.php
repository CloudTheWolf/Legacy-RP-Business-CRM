<?php

use App\Http\Controllers\Authentication\DiscordLogin;
use App\Http\Controllers\Authentication\SteamLogin;
use App\Http\Controllers\Shared\ApplicationAuth;
use Illuminate\Support\Facades\Route;

Route::prefix('/apply')->group(function () {

    Route::get('/',[ApplicationAuth::class,'Discord'])->name('job-application-discord-auth');

    Route::prefix('/auth')->group(function () {
        Route::get('/discord', [DiscordLogin::class, 'getFromApply'])->name('auth.discord-apply');
        Route::get('/discord/handle', [DiscordLogin::class, 'handleApply'])->name('auth.discord-apply.handle');
        Route::get('/steam', [SteamLogin::class, 'get'])->name('apply.auth.steam');
        Route::get('/steam/handle', [SteamLogin::class, 'handle'])->name('apply.auth.steam.handle');
    });
    Route::get('/steam',[ApplicationAuth::class,'Steam'])->name('job-application-steam-auth');

    Route::post('/steam', function (){
        session(['steamID' => 0]);
        return redirect(route('application-set-cid'));
    });

    Route::get('/cid', [ApplicationAuth::class, 'SetCid'])->name('application-set-cid');
    Route::post('/form', [ApplicationAuth::class, 'ShowForm'])->name('mechanic-application-form');
    Route::post('/mechanic-submit',[ApplicationAuth::class,'submitMechanicApplication'])->name('mechanic-application-form-submit');
})->middleware('guest');

Route::Get('/apply-done', function(){
    return view('public.application.application-done');
});
