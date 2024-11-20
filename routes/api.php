<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;

Route::prefix('user')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('sign-in', [AuthController::class, 'login']);
    Route::match(['post', 'patch'], 'recover-password', [AuthController::class, 'recoverPassword']);

    Route::get( 'companies', [CompanyController::class, 'index']);
    Route::post( 'companies', [CompanyController::class, 'store']);

});
