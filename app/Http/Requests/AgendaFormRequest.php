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
            'profissional_id.required' => 'Preencha o campo profissional.',
            'data_hora.required' =>  'Horario obrigatório.',
            'data_hora.date' => 'Formato inválido.',
            'pagamento.required' => 'Preencha o campo.',
            'pagamento.max' => 'O campo deve conter no máximo 20 caracteres.',
            'pagamento.min' => 'O campo deve no mínimo 3 caracteres.',

        ];
    }
}