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
            'avatar' => 'required|mimes:jpg,jpeg,png',
            'age' => 'required|integer|min:1|max:120',
            'phone' => 'required|numeric',
            'cpf' => 'required',
            'observation' => 'nullable',
            'social_name' => 'nullable',
            'symptoms' => 'nullable'
        ];
    }
}
