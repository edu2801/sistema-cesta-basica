<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestInsertCosutumer extends FormRequest
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
            'costumer.name' => 'required',
            'costumer.cpf' => 'unique:costumers,cpf|nullable'
        ];
    }

    public function messages()
    {
        return [
            'costumer.name.required' => 'Nome é obrigatório',
            'costumer.cpf.unique' => 'CPF já cadastrado'
        ];
    }
}
