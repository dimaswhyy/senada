<?php

use App\Http\Controllers\Backend\Yayasan\ProfilController;
use App\Http\Controllers\Backend\Yayasan\UnitController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
});



Auth::routes();

Route::middleware('auth:user,account_yayasan')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('profilyayasan', ProfilController::class);
    Route::resource('unit', UnitController::class);
});
