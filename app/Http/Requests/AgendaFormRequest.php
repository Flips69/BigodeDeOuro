<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AgendaFormRequest extends FormRequest
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
            'profissional_id' => 'required|integer',

            'data_hora' => 'required|date'
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
            'profissional_id.required' => 'Preencha o campo profissional',



            'data_hora.required' =>  'Horario obrigatorio',
            'data_hora.date' => 'formato inválido',


            'pagamento.required' => 'preencha o campo',
            'pagamento.max' => 'o campo deve conter 20 caracteres',
            'pagamento.min' => 'o campo deve no minimo 3 caracteres',

        ];
    }
}