<?php

use App\Http\Controllers\Mechanic\Repair\RepairDelete;
use App\Http\Controllers\Mechanic\Repair\RepairEdit;
use App\Http\Controllers\Shared\Account\EditAccountController;
use Illuminate\Support\Facades\Route;
/**
 * Mechanic
 */
use App\Http\Controllers\Mechanic\Admin\MechanicSettings;
use App\Http\Controllers\Mechanic\Applications\Application as MechanicApplications;
use App\Http\Controllers\Mechanic\DashboardController as MechanicDashboard;
use App\Http\Controllers\Mechanic\Repair\Purchase;
use App\Http\Controllers\Mechanic\Repair\RepairLogger;
use App\Http\Controllers\Mechanic\Repair\Repairs;
use App\Http\Controllers\Mechanic\Tow\TowHistory;
use App\Http\Controllers\Mechanic\Tow\TowTracker;
use App\Http\Controllers\Mechanic\Tow\TowTally;

/**
 * Arcade
 */
use App\Http\Controllers\Arcade\DashboardController as ArcadeDashboard;
use App\Http\Controllers\Arcade\Sales\SalesLogger as ArcadeSalesLogger;
use App\Http\Controllers\Arcade\Admin\ArcadeSettings;

/**
 * Bars
 */
use App\Http\Controllers\Bars\DashboardController as BarDashboard;
use App\Http\Controllers\Bars\Sales\SalesLogger as BarSalesLogger;
use App\Http\Controllers\Bars\Admin\BarSettings;

/**
 * Shared
 */

use App\Http\Controllers\Shared\Admin\AddUserController;
use App\Http\Controllers\Shared\Admin\ApplicationsController;
use App\Http\Controllers\Shared\Admin\ApplicationController;
use App\Http\Controllers\Shared\Admin\EditUserController;
use App\Http\Controllers\Shared\Admin\SettingsController;
use App\Http\Controllers\Shared\Admin\UsersController;
use App\Http\Controllers\Shared\Admin\SpecialsController;
use App\Http\Controllers\Shared\Team\TeamController;
use App\Http\Controllers\Authentication\BasicLogin;
use App\Http\Controllers\Authentication\Logout;
use App\Http\Controllers\Authentication\SteamLogin;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\Shared\Applications\ApplicationWelcome;
use App\Http\Controllers\Shared\Applications\ApplicationSelectProfile;
use App\Http\Controllers\Shared\Applications\BarApplication;
use App\Http\Controllers\Shared\Warehouse\viewAllWarehousesController;
use App\Http\Controllers\Shared\Warehouse\viewWarehouseController;


/** Authentication Controllers **/
/** Mechanic Controllers **/
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

Route::redirect('/', '/dashboard')->middleware('auth');
Route::redirect('/index', '/dashboard')->middleware('auth');

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
});

Route::get('/clock-on/{action}', [ActionController::class, 'ClockInOut'])->middleware('auth');

Route::prefix('/apply')->group(function () {
    Route::get('/', [ApplicationWelcome::class, 'Get']);
    Route::get('/select-profile', [ApplicationSelectProfile::class, 'Get']);
    Route::post('/select-profile', [ApplicationSelectProfile::class, 'Post']);
    Route::prefix('/auth')->group(function () {
        Route::get('/steam', [SteamLogin::class, 'get'])->name('apply.auth.steam');
        Route::get('/steam/handle', [SteamLogin::class, 'handle'])->name('apply.auth.steam.handle');
    });
});

Route::get('/team', [TeamController::class,'Get'])->middleware('auth');

if(config('app.siteMode') == "Mechanic") {
    Route::get('/dashboard', [MechanicDashboard::class, 'Get'])->middleware('auth');


    Route::prefix('/tow')->group(function () {

        Route::post('/', [TowTally::class, 'Post'])->name('tow.tally')->middleware('auth');
        Route::get('/tracker',[TowTracker::class,'Get']);
        Route::post('/tracker',[TowTracker::class,'Post']);

        Route::get('/history',[TowHistory::class,'Get']);
    });

    Route::prefix('/mechanic')->group(function (){
        Route::get('/repair-logger',[RepairLogger::class,'Get']);
        Route::post('/repair-logger',[RepairLogger::class,'Post']);

        Route::get('/repairs',[Repairs::class,'Get']);
        Route::get('/repairs/{id}',[RepairEdit::class,'Get']);
        Route::post('/repairs/{id}',[RepairEdit::class,'Post']);
        Route::get('/repairs/{id}/delete',[RepairDelete::class,'Get']);

        Route::get('/purchase',[Purchase::class,'Get']);
        Route::post('/purchase',[Purchase::class,'Post']);
    });

    Route::post('/apply/done', [MechanicApplications::class, 'Post']);

    Route::prefix('/admin')->group(function (){

        Route::prefix('/applications')->group(function (){
            Route::get('/',[ApplicationsController::class,'Get']);
            Route::get('/{id}',[ApplicationController::class,'Get']);
            Route::post('/{id}',[ApplicationController::class,'Post']);
        });
        Route::get('/past-applications',[ApplicationsController::class,'GetDone']);
        Route::get('/mechanic-settings',[MechanicSettings::class,'Get']);
        Route::post('/mechanic-settings',[MechanicSettings::class,'Post']);

    })->middleware('auth');
}

if(config('app.siteMode') == "Bar") {
    Route::redirect('/', '/dashboard')->middleware('auth');
    Route::get('/dashboard', [BarDashboard::class, 'Get'])->middleware('auth');

    Route::prefix('/bar')->group(function () {
        Route::get('/sale-logger',[BarSalesLogger::class,'Get']);
        Route::post('/sale-logger',[BarSalesLogger::class,'Post']);

        Route::get('/repairs',[Repairs::class,'Get']);
    });

    Route::post('/apply/done', [BarApplication::class, 'Post']);

    Route::prefix('/admin')->group(function (){

        Route::get('/specials',[SpecialsController::class,'Get']);
        Route::post('/specials',[SpecialsController::class,'Post']);
        Route::get('/specials/enable/{id}',[SpecialsController::class,'Enable']);
        Route::get('/specials/disable/{id}',[SpecialsController::class,'Disable']);

        Route::get('/bar-settings',[BarSettings::class,'Get']);
        Route::post('/bar-settings',[BarSettings::class,'Post']);

        Route::prefix('/applications')->group(function (){
            Route::get('/',[ApplicationsController::class,'Get']);
            Route::get('/{id}',[ApplicationController::class,'Get']);
            Route::post('/{id}',[ApplicationController::class,'Post']);
        });

    })->middleware('auth');
}

if(config('app.siteMode') == "Arcade") {
    Route::redirect('/', '/dashboard')->middleware('auth');
    Route::get('/dashboard', [ArcadeDashboard::class, 'Get'])->middleware('auth');

    Route::prefix('/arcade')->group(function () {
        Route::get('/sale-logger',[ArcadeSalesLogger::class,'Get']);
        Route::post('/sale-logger',[ArcadeSalesLogger::class,'Post']);

        Route::get('/repairs',[Repairs::class,'Get']);
    });

    Route::prefix('/admin')->group(function () {

        Route::get('/specials',[SpecialsController::class,'Get']);
        Route::post('/specials',[SpecialsController::class,'Post']);
        Route::get('/specials/enable/{id}',[SpecialsController::class,'Enable']);
        Route::get('/specials/disable/{id}',[SpecialsController::class,'Disable']);

        Route::get('/arcade-settings',[ArcadeSettings::class,'Get']);
        Route::post('/arcade-settings',[ArcadeSettings::class,'Post']);

        Route::prefix('/applications')->group(function (){
            Route::get('/',[ApplicationsController::class,'Get']);
            Route::get('/{id}',[ApplicationController::class,'Get']);
            Route::post('/{id}',[ApplicationController::class,'Post']);
        });
    });
}

if(config('app.siteMode') == "Motorcycle Club")
{
    Route::get('/dashboard', [MechanicDashboard::class, 'Get'])->middleware('auth');
    Route::prefix("/storage")->group(function (){
        Route::get('/',[viewAllWarehousesController::class,'get']);
        Route::get('/{id}',[viewWarehouseController::class,'get']);
    })->middleware('auth');
}

Route::prefix('/admin')->group(function () {

    Route::get('/add-user', [AddUserController::class, 'Get']);
    Route::post('/add-user', [AddUserController::class, 'Post']);

    Route::get('/users', [UsersController::class, 'Get']);
    Route::get('/users/{id}', [EditUserController::class, 'Get']);
    Route::post('/users/{id}', [EditUserController::class, 'Post']);
    Route::get('/settings',[SettingsController::class,'Get']);
    Route::post('/settings',[SettingsController::class,'Post']);

});

Route::get('/account/settings',[EditAccountController::class, 'Get'])->middleware('auth');
Route::post('/account/settings',[EditAccountController::class, 'Post'])->middleware('auth');

/*
|--------------------------------------------------------------------------
| Blank Pages
|--------------------------------------------------------------------------
|
*/
//Route::view('/Horizontal', 'horizontal');
//Route::view('/Vertical', 'vertical');

