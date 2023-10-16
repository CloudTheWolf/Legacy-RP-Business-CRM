<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mechanic\Dashboard;


Route::get('/dashboard', [Dashboard::class,'index'])->name('dashboard');

