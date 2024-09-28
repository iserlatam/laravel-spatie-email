<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'role:admin|manager'])->group(function (){
    // logout/ => void
    Route::post('app/logout', [AuthController::class, 'logout']);
});

// logout/ => user token
Route::post('app/login', [AuthController::class, 'login']);
