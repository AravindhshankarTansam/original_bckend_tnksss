<?php
use App\Http\Controllers\RegisterUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/send-otp', [RegisterUserController::class, 'sendOtp']);
Route::post('/verify-otp', [RegisterUserController::class, 'verifyOtp']);
Route::post('/set-password', [RegisterUserController::class, 'setPassword']);