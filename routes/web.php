<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionToggleController;
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
use App\Http\Controllers\ActionController;
use App\Http\Controllers\Shared\Warehouse\viewAllWarehousesController;
use App\Http\Controllers\Shared\Warehouse\viewWarehouseController;


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

Route::post('/set-session', [SessionToggleController::class,'setSession'])->name('set.session');


require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/shared.php';

if(config('app.siteMode') == "Mechanic") {
    require __DIR__ . '/mechanic.php';
}

if(config('app.siteMode') == "Bar") {
    require __DIR__ . '/bar.php';
}

if(config('app.siteMode') == "Arcade") {
    require __DIR__ . '/arcade.php';
}

if(config('app.siteMode') == "Motorcycle Club") {
    require __DIR__ . '/motorcycle_club.php';
}

if(config('app.siteMode') == "DOJ") {
    require __DIR__ . '/doj.php';
}

if(config('app.siteMode') == "Dealership") {
    require __DIR__ . '/dealership.php';
}
