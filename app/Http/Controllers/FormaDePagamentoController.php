<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormaDePagamentoFormRequest;
use App\Http\Requests\FormaDePagamentoUpdateFormRequest;
use App\Models\FormaDePagamento;
use Illuminate\Http\Request;

class FormaDePagamentoController extends Controller
{

    public function cadastrarTiposDePagamento(FormaDePagamentoFormRequest $request)
    {


        $pagamento = FormaDePagamento::create([
            'tipos_de_pagamento' => $request->tipos_de_pagamento,
            'status_do_pagamento' => $request->status_do_pagamento,
            'taxa' => $request->taxa
        ]);

        if (isset($pagamento)) {

            return response()->json([
                'status' => true,
                'message' => 'Forma de Pagamento cadastrada com sucesso.',
                'data' => $pagamento

            ], 200);
        }
        if (!isset($pagamento)) {
            return response()->json([
                'status' => false,
                'message' => 'Forma de Pagamento não foi cadastrada.',
                'data' => $pagamento

            ], 200);
        }
    }

    public function retornarFormasDePagamento()
    {
        $pagamento = FormaDePagamento::all();

        if (count($pagamento) > 0) {
            return response()->json([
                'status' => true,
                'data' => $pagamento
            ]);
        }
        return response()->json([
            'status' => false,
            'data' => 'Não há nenhuma forma de pagamento registrada'
        ]);
    }

    public function excluirFormaDePagamento($id)
    {
        $pagamento = FormaDePagamento::find($id);
        

        if (!isset($pagamento)) {
            return response()->json([
                'status' => false,
                'message' => "Nenhuma forma de pagamento encontrada."
            ]);
        }

        $pagamento->delete();
        return response()->json([
            'status' => true,
            'message' => "Forma de pagamento excluída com sucesso."
        ]);
    }


    public function editarFormaDePagamento(FormaDePagamentoUpdateFormRequest $request)
    {
        $pagamento = FormaDePagamento::find($request->id);
        if (!isset($pagamento)) {
            return response()->json([
                'status' => false,
                'message' => "Forma de Pagamento não foi encontrada."
            ]);
        }

        if (isset($request->tipos_de_pagamento)) {
            $pagamento->tipos_de_pagamento = $request->tipos_de_pagamento;
        }

        if (isset($request->status_do_pagamento)) {
            $pagamento->status_do_pagamento = $request->status_do_pagamento;
        }
        if (isset($request->taxa)) {
            $pagamento->taxa = $request->taxa;
        }
       
      




        $pagamento->update();

        return response()->json([
            'status' => true,
            'message' => 'Cliente foi atualizado.'
        ]);
    }

    public function retornarTaxas()
    {
        $pagamento = FormaDePagamento::all();

        if (count($pagamento) > 0) {
            
            return response()->json([
                'status' => true,
                'data' => $pagamento->tipos_de_pagamento.": ".$pagamento->taxa
            ]);
        }
        return response()->json([
            'status' => false,
            'data' => 'Não há nenhuma forma de pagamento registrada.'
        ]);
    }

   
}