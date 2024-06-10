<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmprestimoRequest extends FormRequest
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
            'locatario_id' => 'required|exists:locatario,id',
            'livro_id' => 'required|exists:livro,id',
            'data_emprestimo' => 'required',
            'devolucao' => 'required|integer'
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
            'required' => 'O campo :attribute é obrigatório.',
            'exists' => 'O campo :attribute não existe.',
            'integer' => 'O campo :attribute deve ser um número inteiro.'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'locatario_id' => 'Locatário',
            'livro_id' => 'Livro',
            'data_emprestimo' => 'Data de Empréstimo',
            'devolucao' => 'Devolução'
        ];
    }
}
