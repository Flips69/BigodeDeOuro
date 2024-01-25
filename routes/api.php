<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\ServicoController;
use Illuminate\Support\Facades\Route;




//------------------------------------------------------Salvar-------------------------------------------------

Route::post('cadastrar/servico', [ServicoController::class, 'cadastrarServico']);

Route::post('cadastrar/cliente', [ClienteController::class, 'cadastrarCliente']); 

Route::post('cadastrar/profissional', [ProfissionalController::class, 'cadastrarProfissional']);

Route::post('cadastrar/agenda', [AgendaController::class, 'cadastroAgenda']);

//-------------------------------------------------------------------------------------------------------------




//-------------------------------------------------Atualizar---------------------------------------------------

Route::put('update/cliente', [ClienteController::class, 'editarCliente']);

Route::put('update/profissional', [ProfissionalController::class, 'editarProfissional']);

Route::put('update/servico', [ServicoController::class, 'editarServico']);

Route::put('update/agenda', [AgendaController::class, 'editarAgenda']);

//--------------------------------------------------------------------------------------------------------------




//-----------------------------------------------Visualizar-----------------------------------------------------

Route::get('all/cliente', [ClienteController::class, 'retornarTodosClientes']);

Route::get('all/profissional', [ProfissionalController::class, 'retornarTodosProfissionais']);

Route::get('all/servico', [ServicoController::class, 'retornarTodosServicos']);

Route::get('all/agenda', [AgendaController::class, 'retornarTodosAgenda']);

//--------------------------------------------------------------------------------------------------------------




//--------------------------------------------------Excluir-----------------------------------------------------

Route::delete('excluir/cliente/{id}', [ClienteController::class, 'excluirCliente']);

Route::delete('excluir/profissional/{id}', [ProfissionalController::class, 'excluirProfissional']);

Route::delete('excluir/servico/{id}', [ServicoController::class, 'excluirServico']);

Route::delete('excluir/agenda/{id}', [AgendaController::class, 'excluirAgenda']);

//--------------------------------------------------------------------------------------------------------------




//--------------------------------------------Pesquisas-Cliente-------------------------------------------------

Route::post('pesquisar/nome/cliente', [ClienteController::class, 'pesquisarClientePorNome']);

Route::post('pesquisar/cpf/cliente', [ClienteController::class, 'pesquisarClientePorCpf']);

Route::post('pesquisar/celular/cliente', [ClienteController::class, 'pesquisarClientePorCelular']);

Route::post('pesquisar/email/cliente', [ClienteController::class, 'pesquisarClientePorEmail']);

Route::get('find/cliente/{id}',[ClienteController::class, 'pesquisarPorId']);

//--------------------------------------------------------------------------------------------------------------




//------------------------------------------Pesquisas-Profissionais---------------------------------------------

Route::post('pesquisar/nome/profissional', [ProfissionalController::class, 'pesquisarPorNomeProfissional']);

Route::post('pesquisar/cpf/profissional', [ProfissionalController::class, 'pesquisarPorCpfProfissional']);

Route::post('pesquisar/celular/profissional', [ProfissionalController::class, 'pesquisarPorCelularProfissional']);

Route::post('pesquisar/email/profissional', [ProfissionalController::class, 'pesquisarPorEmailProfissional']);

Route::get('find/profissional/{id}',[ProfissionalController::class, 'pesquisarPorId']);

//--------------------------------------------------------------------------------------------------------------




//---------------------------------------------Pesquisas-Serviços----------------------------------------------

Route::get('find/servico/{id}',[ServicoController::class, 'pesquisarPorId']);  

Route::post('pesquisar/nome/servico', [ServicoController::class, 'pesquisarPorNome']);

Route::post('pesquisar/descricao/servico', [ServicoController::class, 'pesquisarPorDescricao']);

//-------------------------------------------------------------------------------------------------------------




//----------------------------------------------Pesquisas-Agenda-----------------------------------------------

Route::post('pesquisar/profissional/agenda', [AgendaController::class, 'pesquisarAgendaPorIdProfissional']); //

Route::get('find/agenda/{id}',[AgendaController::class, 'pesquisarPorId']);

Route::post('pesquisar/data/agenda', [AgendaController::class, 'pesquisarPorData']);

//-------------------------------------------------------------------------------------------------------------




//-----------------------------------------------Recuperar-senha-----------------------------------------------

Route::put ('recuperar/senha/cliente', [ClienteController::class, 'recuperarSenha']);

Route::put ('recuperar/senha/profissional', [ProfissionalController::class, 'recuperarSenha']);

//------------------------------------------------------------------------------------------------------------




//login

Route::post('/login', [ClienteController::class, 'login']);