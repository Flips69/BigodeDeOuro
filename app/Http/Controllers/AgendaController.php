<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgendaFormRequest;
use App\Http\Requests\AgendaUpdateFormRequest;
use App\Models\Agenda;

use App\Models\Profissional;

use Carbon\Carbon;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function cadastroAgenda(AgendaFormRequest $request)
    {

        $dataAtual = Carbon::now('America/Sao_Paulo');

        $data_hora = Carbon::parse($request->data_hora);

        if ($dataAtual->gt($data_hora)) {
            return response()->json([
                "status" => false,
                "error" => ["A data e hora devem ser posteriores ao dia de hoje."]
            ], 400);
        }
        /*
        // Calcula a diferença entre a data/hora agendada e a data atual em horas
        $diferencaHoras = $data_hora->diffInHours($dataAtual);
        
       
        // Verifica se a diferença é menor que 1 hora (60 minutos)
        if ($diferencaHoras < 1) {
            return response()->json([
                "status" => false,
                "message" => "Você só pode agendar com no mínimo 1 hora de antecedência."
            ], 400);
        }*/




        $profissional = Profissional::find($request->profissional_id);

        if (!$profissional) {
            return response()->json([
                "status" => false,
                "message" => "Profissional não foi encontrado."
            ], 400);
        }

        $agendaExistente = Agenda::where('profissional_id', $request->profissional_id)
            ->where('data_hora', $data_hora)
            ->first();

        if ($agendaExistente) {
            return response()->json([
                "status" => false,
                "message" => "Já existe uma agenda cadastrada para essa data e profissional."
            ], 400);
        }


        $agenda = Agenda::create([


            'profissional_id' => $request->profissional_id,
            'cliente_id' => $request->cliente_id,
            'servico_id' => $request->servico_id,
            'data_hora' => $request->data_hora,
            'pagamento' => $request->pagamento,
            'valor' => $request->valor,



        ]);
        return response()->json([
            "status" => true,
            "message" => "Agenda foi cadastrada com sucesso.",
            "data" => $agenda

        ], 200);
    }





    public function pesquisarPorData(Request $request)
    {


        $agenda = Agenda::where('data_hora', 'like', '%' . $request->data_hora . '%')->get();


        if (count($agenda) > 0) {
            return response()->json([
                'status' => true,
                'data' => $agenda
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => "Data não foi encontrada."
        ]);
    }



    public function pesquisarAgendaPorIdProfissional(Request $request)
    {
        $agenda = Agenda::where('profissional_id', 'like', '%' . $request->profissional_id . '%')->get();

        if (count($agenda) > 0) {
            return response()->json([
                'status' => true,
                'data' => $agenda
            ]);
        }




        return response()->json([
            'status' => false,
            'data' => 'Profissional não está disponível.'
        ]);
    }







    public function retornarTodosAgenda()
    {
        $agenda = Agenda::all();

        if (count($agenda) > 0) {
            return response()->json([
                'status' => true,
                'data' => $agenda
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Nenhum registro no sistema.'
        ]);
    }


    public function excluirAgenda($id)
    {
        $agenda = Agenda::find($id);

        if (!isset($agenda)) {
            return response()->json([
                'status' => false,
                'message' => "Agenda não foi encontrada."
            ]);
        }

        $agenda->delete();
        return response()->json([
            'status' => true,
            'message' => "Agenda excluída com sucesso."
        ]);
    }

    public function editarAgenda(Request $request)
    {
        $agenda = Agenda::find($request->id);
        

        if (!isset($agenda)) {
            return response()->json([
                'status' => false,
                'message' => "Agenda não foi encontrada."
            ]);
        }

        $dataAtual = Carbon::now('America/Sao_Paulo');

        $data_hora = Carbon::parse($request->data_hora);

        if ($dataAtual->gt($data_hora)) {
            return response()->json([
                "status" => false,
                "error" => ["A data e hora devem ser posteriores ao dia de hoje."]
            ], 400);
        }



        /* $profissional = Profissional::find($request->profissional_id);

        if (!$profissional) {
            return response()->json([
                "status" => false,
                "message" => "Profissional não encontrado"
            ], 400);
        }

       /* $cliente = Cliente::find($request->cliente_id);

        if (!$cliente) {
            return response()->json([
                "status" => false,
                "message" => "Cliente não encontrado"
            ], 400);
        }

        $servico = Servico::find($request->servico_id);

        if (!$servico) {
            return response()->json([
                "status" => false,
                "message" => "Serviço não encontrado"
            ], 400);
        }*/

        if (isset($request->profissional_id)) {
            $agenda->profissional_id = $request->profissional_id;
        }
        if (isset($request->data_hora)) {
            $agenda->data_hora = $request->data_hora;
        }

        if (isset($request->cliente_id)) {
            $agenda->cliente_id = $request->cliente_id;
        }
        if (isset($request->pagamento)) {
            $agenda->pagamento = $request->pagamento;
        }
        if (isset($request->valor)) {
            $agenda->valor = $request->valor;
        }

        $agenda->update();

        return response()->json([
            'status' => true,
            'message' => 'Agenda foi atualizada.'
        ]);
    }

    public function pesquisarPorId($id)
    {
        $agenda = Agenda::find($id);

        if (!isset($agenda)) {
            return response()->json([
                'status' => false,
                'message' => "Agenda não foi cadastrada."
            ]);
        }
        return response()->json([
            'status' => true,
            'data' => $agenda
        ]);
    }
}  

//Pronto