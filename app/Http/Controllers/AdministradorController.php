<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdministradorFormRequest;
use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdministradorController extends Controller
{

    public function cadastrarAdm(AdministradorFormRequest $request)
    {
        $adm = Administrador::create([


            'nome' => $request->nome,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'password' => Hash::make($request->password)


        ]);

        if (isset($adm)) {

            return response()->json([
                'status' => true,
                'message' => 'Administrador foi cadastrado com sucesso.',
                'data' => $adm

            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Administrador não foi cadastrado.',
            'data' => $adm

        ], 200);
    }

    public function retornarTodosAdm()
    {
        $adm = Administrador::all();

        if (count($adm) > 0) {
            return response()->json([
                'status' => true,
                'data' => $adm
            ]);
        }
        return response()->json([
            'status' => false,
            'data' => 'Não há nenhum administrador registrado.'
        ]);
    }

    public function excluirAdm($id)
    {
        $adm = Administrador::find($id);

        if (!isset($adm)) {
            return response()->json([
                'status' => false,
                'message' => "Administrador não foi encontrado."
            ]);
        }

        $adm->delete();
        return response()->json([
            'status' => true,
            'message' => "Administrador foi excluido com sucesso."
        ]);
    }

    public function editarAdm(Request $request)
    {
        $adm = Administrador::find($request->id);

        if (!isset($adm)) {
            return response()->json([
                'status' => false,
                'message' => "Administrador não foi encontrado."
            ]);
        }

        if (isset($request->nome)) {
            $adm->nome = $request->nome;
        }


        if (isset($request->email)) {
            $adm->email = $request->email;
        }
        if (isset($request->cpf)) {
            $adm->cpf = $request->cpf;
        }

        $adm->update();

        return response()->json([
            'status' => true,
            'message' => 'Administrador foi atualizado.'
        ]);
    }



    public function recuperarSenha(Request $request)
    {

        $adm = Administrador::where('email', '=', $request->email)->first();

        if (!isset($adm)) {
            return response()->json([
                'status' => false,
                'message' => "Email inválido."

            ]);
        }

        $adm = Administrador::where('cpf', '=', $request->cpf)->first();

        if (!isset($adm)) {
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
            $adm->password = $request->password; //Hash::make( $request->password );
        }
        $adm->update();

        return response()->json([
            'status' => true,
            'password' => Hash::make($adm->password)
        ]);
    }
}
