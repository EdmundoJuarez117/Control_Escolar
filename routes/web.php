<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CmodalidadController;
use App\Http\Controllers\CcarreraController;
use App\Http\Controllers\CplanestudioController;
use App\Http\Controllers\CescalaevalController;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware'=>['role:administrador|docente|alumno']],function(){
    Route::get('/modalidades/{offset}/{data}',[CmodalidadController::class, 'index'])->name('/modalidades/{offset}/{data}');
    Route::get('/carreras/{offset}/{data}',[CcarreraController::class, 'index'])->name('/carreras/{offset}/{data}');
    Route::get('/planestudios/{offset}/{data}',[CcarreraController::class, 'index'])->name('/planestudios/{offset}/{data}');
    Route::get('/escalaevals/{offset}/{data}',[CescalaevalController::class, 'index'])->name('/escalaevals/{offset}/{data}');
    
    Route::resource('/modalidades', CmodalidadController::class)->name("*",'modalidades');
    Route::resource('/carreras', CcarreraController::class)->name("*",'carreras');
    Route::resource('/planestudios', CplanestudioController::class)->name("*",'planestudios');
    Route::resource('/escalaevals', CescalaevalController::class)->name("*",'escalaevals');
    //Route::resource('carreras', 'App\Http\Controllers\CcarreraController');
    //Route::resource('planestudios', 'App\Http\Controllers\CplanestudioController');
//    Route::resource('escalaeval', 'App\Http\Controllers\CescalaevalController');

});