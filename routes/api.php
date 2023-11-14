<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\userController;
use App\Http\Controllers\api\LoanUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::post('/register',[userController::class,'register']);

// Route::post('/login',[userController::class,'login']);

Route::post('/create',[LoanUserController::class,'store']);

Route::post('/credit_limit',[LoanUserController::class,'credit_limit']);

Route::post('/charges_calculate',[LoanUserController::class,'charges_calculate']);

Route::post('/apply_loan',[LoanUserController::class,'apply_loan']);






