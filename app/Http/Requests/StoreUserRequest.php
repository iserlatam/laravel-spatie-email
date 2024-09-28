<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|alpha',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|alpha_num'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'El correo es obligatorio',
            'email.email' => 'Ha introducido un formato de correo erróneo',
            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'La contraseña debe tener más de 6 caracteres'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ], 400));
    }
}
