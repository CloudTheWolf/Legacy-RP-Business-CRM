<?php

use App\Http\Controllers\Shared\Team;
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

include_once __DIR__ . '/auth.php';
include_once __DIR__ . '/shared.php';

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', ])->group(function () {
    Route::get('/team',[Team::class,'index'])->name('team-page');

});

if (config('app.siteMode') == "Mechanic") {
    include_once __DIR__ . '/mechanic.php';
}

if (config('app.siteMode') == "Shop") {
    include_once __DIR__ . '/shop.php';
}
