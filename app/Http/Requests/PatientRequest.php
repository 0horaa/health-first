<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:6|max:80',
            'avatar' => 'mimes:jpg,jpeg,png',
            'age' => 'required|integer|min:1|max:120',
            'phone' => 'required',
            'cpf' => 'required|cpf',
            'observation' => 'nullable',
            'social_name' => 'nullable',
            'symptoms' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'Não foi possível fazer o registro do paciente. Por favor, preencha todos os campos obrigatórios.',
            '*.min' => 'Não foi possível fazer o registro do paciente. Por favor, preencha todos os campos com os caracteres mínimos.',
            '*.max' => 'Não foi possível fazer o registro do paciente. Por favor, preencha todos os campos com os caracteres máximos.',
            '*.mimes' => 'Não foi possível fazer o registro do paciente. Por favor, selecione uma imagem válida para definir o avatar.',
            'cpf.cpf' => 'Não foi possível fazer o registro do paciente. Por favor, insira um CPF válido.',
        ];
    }
}
