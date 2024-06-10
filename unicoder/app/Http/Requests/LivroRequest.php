<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LivroRequest extends FormRequest
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
            'titulo' => 'required|max:255',
            'autor' => 'required|max:255',
            'genero' => 'required|max:255',
            'editora' => 'required|max:255',
            'edicao' => 'required|numeric',
            'volume' => 'required|numeric',
            'paginas' => 'required|numeric',
            'quantidade' => 'required|numeric',
            'isbn' => 'required|numeric|digits:13|unique:livro,isbn,'. $this->route('livro') . ',id',
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
            'max' => 'O campo :attribute deve ter no máximo :max caracteres.',
            'numeric' => 'O campo :attribute deve ser um número.',
            'digits' => 'O campo :attribute deve ter :digits dígitos.',
            'unique' => 'O campo :attribute já está cadastrado.',
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
            'titulo' => 'título',
            'autor' => 'autor',
            'genero' => 'gênero',
            'editora' => 'editora',
            'edicao' => 'edição',
            'volume' => 'volume',
            'paginas' => 'páginas',
            'quantidade' => 'quantidade',
            'isbn' => 'ISBN',
        ];
    }
}
