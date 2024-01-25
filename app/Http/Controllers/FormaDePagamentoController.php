<?php

namespace App\Http\Controllers;

use App\Models\FormaDePagamento;
use Illuminate\Http\Request;

class FormaDePagamentoController extends Controller
{
    
    public function cadastrarTiposDePagamento(Request $request)
    {


        $pagamento = FormaDePagamento::create([
            'tipos_de_pagamento' => $request->tipos_de_pagamento
        ]);
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
            'data' => 'Não há nenhuma forma de pagamento registrada.'
        ]);
    }

    public function excluirFormaDePagamento($id)
    {
        $pagamento = FormaDePagamento::find($id);
        $tipoDePagamento = $pagamento->tipos_de_pagamento;

        if(!isset($pagamento)) {
            return response()->json([
                'status' => false,
                'message' => "Nenhum tipo de pagamento encontrado."
            ]);
        }

        $pagamento->delete();
        return response()->json([
            'status' => true,
            'message' => "Tipo de Pagamento: ".$tipoDePagamento." excluído com sucesso"
        ]);
    }
}
