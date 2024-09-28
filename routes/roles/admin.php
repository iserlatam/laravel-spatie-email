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

// Custom api routes
// api/

// User | admin routes
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {

    Route::apiResource('app/users', UserController::class)->only([
        "store"
    ]);

    Route::post('app/send-user', function (Request $request) {
        $name = "Jaime Gamer";

        // The email sending is done using the to method on the Mail facade
        Mail::to($request->emailTo)->send(new SendUserEmail($name));

        return response()->json([
            "message" => "correo enviado exitosamente a $request->emailTo",
        ], 200);
    });
});

