<?php

use App\Http\Controllers\BoardingController;
use App\Http\Controllers\LoginController;
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

// Login
Route::get('/login','App\Http\Controllers\LoginController@showFormLogin')->name('login');
Route::post('/login/do','App\Http\Controllers\LoginController@login')->name('login.do');
Route::get('/logout','App\Http\Controllers\LoginController@logout')->name('logout');
Route::get('/home',[LoginController::class,'home'])->name('home');

Route::get('/', function () {
    return redirect('boarding');
});
Route::get('boarding/finish',[BoardingController::class,'boardingFinish'])->name('finish');

Route::resource('boarding',BoardingController::class);