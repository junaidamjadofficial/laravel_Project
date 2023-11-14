<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\LoanUserController;
use App\Http\Controllers\api\User_Loan_Controller;


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

Route::get('/',[LoanUserController::class,'index'])->name('Loan_User_profile.index');
Route::get('/edit/{id}',[LoanUserController::class,'edit'])->name('Loan_User_profile.edit');
Route::put('/edit/{id}',[LoanUserController::class,'update'])->name('Loan_User_profile.update');
Route::delete('/delete/{id}',[LoanUserController::class,'destroy'])->name('Loan_User_profile.destroy');
Route::get('loan_users/{id}', [LoanUserController::class, 'show'])->name('Loan_user_profile.show');


Route::get('/user_loan',[User_Loan_Controller::class,'index'])->name('User_loan_profile.index');
Route::get('/user_loan/edit/{id}',[User_Loan_Controller::class,'edit'])->name('User_loan_profile.edit');
Route::put('/user_loan/edit/{id}',[User_Loan_Controller::class,'update'])->name('User_loan_profile.update');
Route::get('user_loans/{id}', [User_Loan_Controller::class, 'show'])->name('User_loan_profile.show');
Route::delete('user_loans/delete/{id}',[User_Loan_Controller::class,'destroy'])->name('User_loan_profile.destroy');