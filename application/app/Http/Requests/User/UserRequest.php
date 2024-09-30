<?php


namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'remember' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo name é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O email informado é inválido.',
            'password.required' => 'O campo password é obrigatório.',
            'password.min' => 'A senha deve conter pelo menos 6 caracteres.',
            'remember.required' => 'O campo remember é obrigatório.',
            'remember.boolean' => 'O campo remember deve ser verdadeiro ou falso.',
        ];
    }
}
