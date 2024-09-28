<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;
use App\Mail\SendUserEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

require __DIR__.'/roles/common.php';
require __DIR__.'/roles/admin.php';
require __DIR__.'/roles/manager.php';
require __DIR__.'/roles/adminManager.php';
