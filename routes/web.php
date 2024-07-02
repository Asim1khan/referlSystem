<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/wellcom', function () {
    return view('welcome');
});




Route::get('/',[UserController::class,'register']);

Route::post('/user/register',[UserController::class,'StoreRegister'])->name('user.register');
Route::get('/referl-register',[UserController::class,'loadReferralRegister']);
