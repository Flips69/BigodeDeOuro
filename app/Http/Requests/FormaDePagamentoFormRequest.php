<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FormaDePagamentoFormRequest extends FormRequest
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
            'tipos_de_pagamento' => 'required|unique:forma_de_pagamentos,tipos_de_pagamento'.$this->id,
            'status_do_pagamento'=> 'required',
            'taxa'=>'decimal:2,4'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $validator->errors()
        ]));
    }

    public function messages()
    {
        return  [
            'tipos_de_pagamento.required' => 'Este campo é obrigatório.',
            'tipos_de_pagamento.unique' => 'Método de Pagamento já existente.',
            'taxa.decimal' => 'Campo só aceita números decimais.',
        ];
    }
}