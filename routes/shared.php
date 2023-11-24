<?php

use App\Http\Controllers\Shared\ClockInSystem;
use App\Http\Controllers\Shared\DiscordSettings;
use App\Http\Controllers\Shared\ManageUsers;
use App\Http\Controllers\Shared\SiteSettings;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('/admin')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', ])->group(function (){
    Route::get('/discord-settings',[DiscordSettings::class,'index'])->name('admin-discord-settings');
    Route::get('/manage-users',[ManageUsers::class, 'List'])->name('admin-manage-users');
    Route::get('/manage-disabled-users',[ManageUsers::class, 'ListDisabled'])->name('admin-manage-disabled-users');
    Route::get('/add-user',[ManageUsers::class, 'Add'])->name('admin-add-user');
    Route::get('/manage-users/{id}',[ManageUsers::class, 'Edit'])->name('admin-manage-user');
    Route::get('/site-settings',[SiteSettings::class,'index'])->name('admin-site-settings');
});

Route::get('clock-on/{action}',[ClockInSystem::class,'handle'])->name('clock-in-system')
    ->middleware(['auth:sanctum', config('jetstream.auth_session')]);
