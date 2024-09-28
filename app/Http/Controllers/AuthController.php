<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Login
    public function login(LoginRequest $request)
    {
        $fields = $request->validated();

        $user = User::where('email', $fields['email'])->first();

        if (!$user) {
            return response([
                "message" => "Este correo no está registrado en el sistema",
                "status" => 404
            ], 404);
        }

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Credenciales incorrectas',
            'status' => Response::HTTP_UNAUTHORIZED,
            ], 401);
        }

        $userToken = $user->createToken(
            "session-user-token",
            ["can-edit", "show-users"])
            ->plainTextToken;

        return response()->json([
            "token" => $userToken,
            "email" => $user->email,
            "tokenUser" => $user->tokens
        ]);
    }

    public function logout(Request $request)
    {
        return $request->user()->tokens()->delete();

        // return response()->status(Response::HTTP_NO_CONTENT);
    }
}
