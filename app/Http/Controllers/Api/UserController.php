<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use ErrorException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): UserCollection
    {
        return new UserCollection(User::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request) // 2. Validar desde el servidor y enviar respuesta. OK
    {
        $fields = $request->validated();

        // return $fields['email'];

        // Creamos el usuario
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
        ]);

        // Asignar el rol

        // Devolvemos una respuesta
        return response()->json([
            "user" => new UserResource($user),
            "status" => Response::HTTP_CREATED
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new UserResource(User::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
