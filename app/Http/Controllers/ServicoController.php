<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServicoFormRequest;
use App\Http\Requests\ServicoUpdateFormRequest;
use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function cadastrarServico(ServicoFormRequest $request)
    {

        $servico = Servico::create([


            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'duracao' => $request->duracao,
            'preco' => $request->preco


        ]);
        return response()->json([
            "status" => true,
            "message" => "Serviço Cadastrado com sucesso",
            "data" => $servico

        ], 200);
    }



    public function retornarTodosServicos()
    {
        $servico = Servico::all();
        if (isset($servico)) {
            return response()->json([
                'status' => true,
                'data' => $servico
            ]);
        }

        return response()->json([
            'status' => false,
            'data' => 'Não há nenhum registro no sistema!'
        ]);
    }

    public function editarServico(ServicoUpdateFormRequest $request)
    {
        $servico = Servico::find($request->id);
        if (!isset($servico)) {
            return response()->json([
                'status' => false,
                'message' => "Serviço não Sencontrado"
            ]);
        }

        if (isset($request->nome)) {
            $servico->nome = $request->nome;
        }

        if (isset($request->descricao)) {
            $servico->descricao = $request->descricao;
        }
        if (isset($request->duracao)) {
            $servico->duracao = $request->duracao;
        }
        if (isset($request->preco)) {
            $servico->preco = $request->preco;
        }




        $servico->update();

        return response()->json([
            'status' => true,
            'message' => 'Serviço atualizado.'
        ]);
    }

    public function excluirServico($id)
    {
        $servico = Servico::find($id);

        if (!isset($servico)) {
            return response()->json([
                'status' => false,
                'message' => "Serviço não encontrado"
            ]);
        }

        $servico->delete();
        return response()->json([
            'status' => true,
            'message' => "Serviço excluido com sucesso!"
        ]);
    }


    //Pesquisas

    public function pesquisarPorId($id)
    {
        $servico = Servico::find($id);

        if (!isset($servico)) {
            return response()->json([
                'status' => false,
                'message' => "Serviço não encontrado"
            ]);
        }
        return response()->json([
            'status' => true,
            'data' => $servico
        ]);
    }

    public function pesquisarPorNome(Request $request)
    {
        $servico = Servico::where('nome', 'like', '%' . $request->nome . '%')->get();


        if (count($servico) > 0) {
            return response()->json([
                'status' => true,
                'data' => $servico
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => "Servico não encontrado"
        ]);
    }

    public function pesquisarPorDescricao(Request $request)
    {
        $servico = Servico::where('descricao', 'like', '%' . $request->descricao . '%')->get();


        if (count($servico) > 0) {
            return response()->json([
                'status' => true,
                'data' => $servico
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => "Descrição não foi encontrado"
        ]);
    }
}

//Pronto