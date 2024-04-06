<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PinjamKunci;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login',[UserController::class,'index'])->name('login')->middleware('guest');
Route::post('/login',[UserController::class,'login']);
Route::get('/register',[UserController::class,'registerView'])->middleware('auth');
Route::post('/register',[UserController::class,'register']);
Route::post('/logout', [UserController::class,'logout']);
Route::get('/mahasiswa',[MahasiswaController::class,'index']);
Route::post('/mahasiswa',[MahasiswaController::class,'index']);


//Dashboard Controller
Route::get('/dashboard',[DashboardController::class,'index'])->middleware('auth');

//Ruangan Controller
Route::get('/ruangan',[RuanganController::class,'index'])->middleware('auth');
Route::post('/ruangan',[RuanganController::class,'storeruangan']);
Route::put('/ruangan/{id}',[RuanganController::class,'edit']);
Route::delete('/ruangan/{id}',[RuanganController::class,'destory']);

//Fasilitas Controller
Route::get('/fasilitas',[FasilitasController::class,'index'])->middleware('auth');
Route::post('/fasilitas',[FasilitasController::class,'storefasilitas']);
Route::put('/fasilitas/{id}',[FasilitasController::class,'edit']);
Route::delete('/fasilitas/{id}',[FasilitasController::class,'destroy']);

//Booking Controller
Route::get('/booking',[BookingController::class,'index'])->middleware('auth');
Route::post('/booking',[BookingController::class,'storebooking']);
Route::put('/booking/{id}',[BookingController::class,'edit']);
Route::delete('/booking/{id}',[BookingController::class,'destroy']);

// Dosen Controller
Route::get('/dosen',[DosenController::class,'index'])->middleware('auth');
Route::post('/dosen',[DosenController::class,'dosenregister']);