<?php

use App\Http\Controllers\ModeController;
use App\Http\Controllers\RfidController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//MODE
Route::post('/moderfid',[ModeController::class,'scanmode']);
Route::get('/getmode',[ModeController::class,'getmode']);

//RFID
Route::post('/registerRfid',[RfidController::class,'registerRfid']);
