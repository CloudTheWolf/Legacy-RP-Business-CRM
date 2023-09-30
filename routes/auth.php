<?php

use App\Http\Controllers\Authentication\BasicLogin;
use App\Http\Controllers\Authentication\Logout;
use App\Http\Controllers\Authentication\SteamLogin;
use App\Http\Controllers\Authentication\DiscordLogin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
|
| All routes relating to authentication
|
*/

Route::prefix('/login')->group(function()
{
    Route::get('/',[BasicLogin::class,'Get'])->name('login');;
    Route::post('/',[BasicLogin::class,'Post']);
});
Route::get('/logout',[Logout::class,'Get'])->middleware('auth');

Route::prefix('/auth')->group(function ()
{
    Route::get('/steam', [SteamLogin::class,'get'])->name('auth.steam');
    Route::get('/steam/handle', [SteamLogin::class,'handle'])->name('auth.steam.handle');
    Route::get('/discord', [DiscordLogin::class,'get'])->name('auth.discord');
    Route::get('/discord/handle',[DiscordLogin::class,'handle'])->name('auth.discord.handle');
});
