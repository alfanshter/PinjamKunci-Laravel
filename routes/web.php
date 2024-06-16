<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\FasilitasRfidController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ModeController;
use App\Http\Controllers\PinjamKunci;
use App\Http\Controllers\RfidController;
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

//Fasilitas Controller
Route::get('/fasilitas',[FasilitasController::class,'index'])->middleware('auth');
Route::post('/fasilitas',[FasilitasController::class,'storefasilitas']);
Route::put('/fasilitas/{id}',[FasilitasController::class,'edit']);
Route::delete('/fasilitas/{id}',[FasilitasController::class,'destroy']);

//Booking Controller
Route::get('/booking',[BookingController::class,'index'])->middleware('auth');
Route::post('/booking',[BookingController::class,'storebooking']);
Route::post('/bookingDone',[BookingController::class,'done']);
Route::put('/booking/{id}',[BookingController::class,'edit']);
Route::delete('/booking/{id}',[BookingController::class,'destroy']);
Route::get('/peminjaman',[BookingController::class,'peminjaman'])->middleware('auth');

// Dosen Controller
Route::get('/dosen',[DosenController::class,'index'])->middleware('auth');
Route::post('/dosen',[DosenController::class,'dosenregister']);

//RFID
Route::get('/rfid',[RfidController::class,'index'])->middleware('auth');
Route::put('/rfid/{id}',[RfidController::class,'edit'])->middleware('auth');
Route::delete('/rfid/{id}',[RfidController::class,'destroy']);

//FasilitasRfid

Route::post('/fasilitasRfid',[FasilitasRfidController::class,'store']);
