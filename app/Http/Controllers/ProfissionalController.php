<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfissionalFormRequest;
use App\Http\Requests\ProfissionalUpdateFormRequest;
use App\Models\Agenda;
use App\Models\Profissional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfissionalController extends Controller
{

    public function cadastrarProfissional(ProfissionalFormRequest $request)
    {

        $profissional = Profissional::create([


            'nome' => $request->nome,
            'celular' => $request->celular,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'dataNascimento' => $request->dataNascimento,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            'pais' => $request->pais,
            'rua' => $request->rua,
            'numero' => $request->numero,
            'bairro' => $request->bairro,
            'cep' => $request->cep,
            'complemento' => $request->complemento,
            'password' => Hash::make($request->password),
            'salario' => $request->salario


        ]);
        if (isset($profissional)) {
            return response()->json([
                "status" => true,
                'title' => 'Cadastrado',
                "message" => "Profissional foi cadastrado com sucesso.",
                "data" => $profissional

            ], 200);
        }
    }


    public function retornarTodosProfissionais()
    {
        $profissional = Profissional::all();

        if (count($profissional) > 0) {
            return response()->json([
                'status' => true,
                'data' => $profissional
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => "Nenhum profissional foi registrado."
        ]);
    }


    public function excluirProfissional($id)
    {
        $profissional = Profissional::find($id);

        if (!isset($profissional)) {
            return response()->json([
                'status' => false,
                'message' => "Profissional não foi encontrado."
            ]);
        }

        $agenda = Agenda::where('profissional_id', $id)->first();

        if ($agenda) {
            return response()->json([
                'status' => false,
                'message' => "Não é possível excluir o profissional, pois há uma agenda associada a ele."
            ]);
        }

        $profissional->delete();
        return response()->json([
            'status' => true,
            'message' => "Profissional excluído com sucesso."
        ]);
    }


    public function editarProfissional(ProfissionalUpdateFormRequest $request)
    {
        $profissional = Profissional::find($request->id);
        if (!isset($profissional)) {
            return response()->json([
                'status' => false,
                'message' => "Profissional não foi encontrado."
            ]);
        }

        if (isset($request->nome)) {
            $profissional->nome = $request->nome;
        }

        if (isset($request->celular)) {
            $profissional->celular = $request->celular;
        }
        if (isset($request->email)) {
            $profissional->email = $request->email;
        }
        if (isset($request->cpf)) {
            $profissional->cpf = $request->cpf;
        }
        if (isset($request->dataNascimento)) {
            $profissional->dataNascimento = $request->dataNascimento;
        }
        if (isset($request->cidade)) {
            $profissional->cidade = $request->cidade;
        }
        if (isset($request->estado)) {
            $profissional->estado = $request->estado;
        }
        if (isset($request->pais)) {
            $profissional->pais = $request->pais;
        }
        if (isset($request->rua)) {
            $profissional->rua = $request->rua;
        }
        if (isset($request->numero)) {
            $profissional->numero = $request->numero;
        }
        if (isset($request->bairro)) {
            $profissional->bairro = $request->bairro;
        }
        if (isset($request->cep)) {
            $profissional->cep = $request->cep;
        }
        if (isset($request->complemento)) {
            $profissional->complemento = $request->complemento;
        }
        if (isset($request->password)) {
            $profissional->password = $request->password;
        }
        if (isset($request->salario)) {
            $profissional->salario = $request->salario;
        }




        $profissional->update();

        return response()->json([
            'status' => true,
            'message' => 'Profissional foi atualizado.'
        ]);
    }

    //Pesquisas
    public function pesquisarPorId($id)
    {
        $profissional = Profissional::find($id);

        if (!isset($profissional)) {
            return response()->json([
                'status' => false,
                'message' => "Cliente não está cadastrado."
            ]);
        }
        return response()->json([
            'status' => true,
            'data' => $profissional
        ]);
    }



    public function pesquisarPorNomeProfissional(Request $request)
    {
        $profissional = Profissional::where('nome', 'like', '%' . $request->nome . '%')->get();



        if (count($profissional) > 0) {
            return response()->json([
                'status' => true,
                'data' => $profissional
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => "Nome não foi encontrado."
        ]);
    }



    public function pesquisarPorCpfProfissional(Request $request)
    {
        $profissional = Profissional::where('cpf', '=', $request->cpf)->first();



        if (isset($profissional)) {
            return response()->json([
                'status' => true,
                'data' => $profissional
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => "CPF não foi encontrado."
        ]);
    }

    public function pesquisarPorEmailProfissional(Request $request)
    {
        $profissional = Profissional::where('email', '=', $request->email)->first();



        if (isset($profissional)) {

            return response()->json([
                'status' => true,
                'data' => $profissional
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => "E-mail não foi encontrado."
        ]);
    }

    public function pesquisarPorCelularProfissional(Request $request)
    {
        $profissional = Profissional::where('celular', 'like', '%' . $request->celular . '%')->get();

        if (count($profissional) > 0) {
            return response()->json([
                'status' => true,
                'data' => $profissional
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => "Celular não foi encontrado."
        ]);
    }


    public function recuperarSenha(Request $request)
    {

       $profissional = Profissional::where('email', '=', $request->email)->first();

        if (!isset($profissional)) {
            return response()->json([
                'status' => false,
                'message' => "Email está inválido."

            ]);
        }

       $profissional = Profissional::where('cpf', '=', $request->cpf)->first();

        if (!isset($profissional)) {
            return response()->json([
                'status' => false,
                'message' => "Cpf não foi encontrado."

            ]);
        }
        if (!isset($request->password)) {
            return response()->json([
                'status' => false,
                'message' => "Escreva a nova senha."

            ]);
        }
        if (isset($request->password)) {
           $profissional->password = $request->password; //Hash::make( $request->password );
        }
       $profissional->update();

        return response()->json([
            'status' => true,
            'password' => Hash::make($profissional->password)
        ]);
    } 
}

//Pronto