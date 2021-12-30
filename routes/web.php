<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\TowController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\PublicController;

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

Route::get('/', [DashController::class,'showDashboard'])->middleware('auth');
Route::get('/index', [DashController::class,'showDashboard'])->middleware('auth');

Route::get('/admin/add-user', [AdminController::class,'CreateUserView'])->middleware('auth');
Route::post('/admin/add-user', [AdminController::class,'CreateUserPost'])->middleware('auth');

Route::get('/admin/users/{id}',[AdminController::class,'editUserView'])->middleware('auth');
Route::get('/admin/users',[AdminController::class,'editUserList'])->middleware('auth');
Route::post('/admin/edit-user',[AdminController::class,'saveUserOnPost'])->middleware('auth');
Route::get('/admin/storage',[AdminController::class,'ViewAllStorage'])->middleware('auth');


Route::get('/edit-user',[AccountController::class,'editUserView'])->middleware('auth');
Route::post('/edit-user/save',[AccountController::class,'saveUserOnPost'])->middleware('auth');


Route::get('/buying', [RepairController::class,'getBuyTemplate'])->middleware('auth');
Route::post('/buying', [RepairController::class,'saveBuyTemplate'])->middleware('auth');

Route::get('/repair/{id}', [RepairController::class,'repairFormEdit'])->middleware('auth');
Route::get('/delete-repair/{id}', [RepairController::class,'repairFormDelete'])->middleware('auth');
Route::get('/restore-repair/{id}', [RepairController::class,'repairFormUnDelete'])->middleware('auth');

Route::post('/repair/{id}', [RepairController::class,'repairFormUpdate'])->middleware('auth');

Route::get('/repairs', [RepairController::class,'repairForm'])->middleware('auth');
Route::post('/repairs', [RepairController::class,'repairFormLog'])->middleware('auth');
Route::get('/repairsLog', [RepairController::class,'repairLog'])->middleware('auth');

Route::get('/receipt/{id}.{cost}',[InvoiceController::class,'viewInvoice']);

Route::get('/login', function () {
    return view('authentication-signin');
})->name('login');

Route::post('/login',[LoginController::class,'authenticate']);

Route::get('/logout',[LoginController::class,'logout'])->middleware('auth');
Route::get('/tow',[TowController::class,'viewPage'])->name('tow')->middleware('auth');
Route::get('/tow-live',[TowController::class,'viewLivePage'])->name('tow-live')->middleware('auth');

Route::post('/tow',[TowController::class,'addTally'])->name('tow.tally')->middleware('auth');
Route::post('/tow/submit',[TowController::class,'submit'])->middleware('auth');

Route::get('/clock-on/{action}',[ActionController::class,'ClockInOut'])->middleware('auth');

Route::get('/team',[TeamsController::class,'viewTeam'])->middleware('auth');

Route::get('/apply',[PublicController::class,'applicationForm']);
Route::post('/apply',[PublicController::class,'applicationFormSubmit']);


