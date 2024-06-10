<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:255|min:3',
            'email' => 'required|max:255|email|unique:users,email',
            'password' => 'required|confirmed',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'required' => 'O campo de :attribute é obrigatório.',
            'password.required' => 'O campo de senha é obrigatório.',
            'max' => 'O campo :attribute deve ter no máximo :max caracteres.',
            'email' => 'O e-mail inserido ser um endereço de e-mail válido.',
            'email.unique' => 'O e-mail informado já está em uso.',
            'password.confirmed' => 'A confirmação de senha não confere com a senha digitada.'
        ];
    }

    /**
     * Get the attributes that apply to the request.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'nome' => 'Nome',
            'email' => 'E-mail',
            'password' => 'Senha',
        ];
    }




}
