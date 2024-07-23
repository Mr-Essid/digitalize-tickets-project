<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailVerificationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/client/email-verification/{id_}', EmailVerificationController::class);