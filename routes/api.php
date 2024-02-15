<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FormaDePagamentoController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\ServicoController;
use App\Http\Middleware\IsAuthenticated;
use App\Http\Middleware\SetSanctumGuard;
use App\Http\Middleware\VerifyAdminGuard;
use App\Models\Administrador;
use Illuminate\Support\Facades\Route;

//ADMIN

Route::post('admin/cadastrar/servico', [ServicoController::class, 'cadastrarServico']);

Route::post('admin/cadastrar/cliente', [ClienteController::class, 'cadastrarCliente']); 

Route::post('admin/cadastrar/profissional', [ProfissionalController::class, 'cadastrarProfissional']);

Route::post('admin/cadastrar/agenda', [AgendaController::class, 'cadastroAgenda']);

Route::post('admin/cadastrar/pagamento', [FormaDePagamentoController::class, 'cadastrarTiposDePagamento']);

//ADMIN -> VIZUALIZAR

Route::put ('admin/recuperar/senha/profissional', [ProfissionalController::class, 'recuperarSenha']);

Route::get('admin/all/cliente', [ClienteController::class, 'retornarTodosClientes']);

Route::get('admin/all/profissional', [ProfissionalController::class, 'retornarTodosProfissionais']);

Route::get('admin/all/servico', [ServicoController::class, 'retornarTodosServicos']);

Route::get('admin/all/agenda', [AgendaController::class, 'retornarTodosAgenda']);

Route::get('admin/all/metodoDePagamento', [FormaDePagamentoController::class, 'retornarFormasDePagamento']);
Route::get('admin/all/taxa/metodoDePagamento', [FormaDePagamentoController::class, 'retornarTaxas']);

//ADMIN -> EDITAR

Route::put('admin/update/cliente', [ClienteController::class, 'editarCliente']);

Route::put('admin/update/profissional', [ProfissionalController::class, 'editarProfissional']);

Route::put('admin/update/servico', [ServicoController::class, 'editarServico']);

Route::put('admin/update/agenda', [AgendaController::class, 'editarAgenda']);

Route::put('admin/update/metodoDePagamento', [FormaDePagamentoController::class, 'editarFormaDePagamento']);

//ADMIN -> EXCLUIR

Route::delete('admin/excluir/cliente/{id}', [ClienteController::class, 'excluirCliente']);

Route::delete('admin/excluir/profissional/{id}', [ProfissionalController::class, 'excluirProfissional']);

Route::delete('admin/excluir/servico/{id}', [ServicoController::class, 'excluirServico']);

Route::delete('admin/excluir/agenda/{id}', [AgendaController::class, 'excluirAgenda']);

Route::delete('admin/excluir/metodoDePagamento/{id}', [FormaDePagamentoController::class, 'excluirFormaDePagamento']);

//ADMIN -> PESQUISAS

Route::post('admin/pesquisar/nome/cliente', [ClienteController::class, 'pesquisarClientePorNome']);

Route::post('admin/pesquisar/cpf/cliente', [ClienteController::class, 'pesquisarClientePorCpf']);

Route::post('admin/pesquisar/celular/cliente', [ClienteController::class, 'pesquisarClientePorCelular']);

Route::post('admin/pesquisar/email/cliente', [ClienteController::class, 'pesquisarClientePorEmail']);

Route::get('admin/find/cliente/{id}',[ClienteController::class, 'pesquisarPorId']);


Route::post('admin/pesquisar/nome/profissional', [ProfissionalController::class, 'pesquisarPorNomeProfissional']);

Route::post('admin/pesquisar/cpf/profissional', [ProfissionalController::class, 'pesquisarPorCpfProfissional']);

Route::post('admin/pesquisar/celular/profissional', [ProfissionalController::class, 'pesquisarPorCelularProfissional']);

Route::post('admin/pesquisar/email/profissional', [ProfissionalController::class, 'pesquisarPorEmailProfissional']);

Route::get('admin/find/profissional/{id}',[ProfissionalController::class, 'pesquisarPorId']);


Route::get('admin/find/servico/{id}',[ServicoController::class, 'pesquisarPorId']);  

Route::post('admin/pesquisar/nome/servico', [ServicoController::class, 'pesquisarPorNome']);

Route::post('admin/pesquisar/descricao/servico', [ServicoController::class, 'pesquisarPorDescricao']);




Route::post('admin/pesquisar/profissional/agenda', [AgendaController::class, 'pesquisarAgendaPorIdProfissional']); //

Route::get('admin/find/agenda/{id}',[AgendaController::class, 'pesquisarPorId']);

Route::post('admin/pesquisar/data/agenda', [AgendaController::class, 'pesquisarPorData']);

//-------------------------------------------------------------------------------------------------------------

//PROFISSIONAL
Route::post('profissional/cadastrar/agenda', [AgendaController::class, 'cadastroAgenda']);

Route::post('profissional/cadastrar/cliente', [ClienteController::class, 'cadastrarCliente']); 



Route::get('all/pagamento', [FormaDePagamentoController::class, 'retornarFormasDePagamento']);

Route::delete('excluir/pagamento/{id}', [FormaDePagamentoController::class, 'excluirFormaDePagamento']);

//------------------------------------------------------Salvar-------------------------------------------------

Route::post('cadastrar/servico', [ServicoController::class, 'cadastrarServico']);

Route::post('cadastrar/cliente', [ClienteController::class, 'cadastrarCliente']); 

Route::post('cadastrar/profissional', [ProfissionalController::class, 'cadastrarProfissional']);

Route::post('cadastrar/agenda', [AgendaController::class, 'cadastroAgenda']);

Route::post('cadastrar/admin', [AdministradorController::class, 'cadastrarAdm']);

//-------------------------------------------------------------------------------------------------------------

Route::get('admin/find/metodoDePagamento/{id}',[FormaDePagamentoController::class, 'pesquisarPorId']);



//-------------------------------------------------Atualizar---------------------------------------------------

Route::put('update/cliente', [ClienteController::class, 'editarCliente']);

Route::put('update/profissional', [ProfissionalController::class, 'editarProfissional']);

Route::put('update/servico', [ServicoController::class, 'editarServico']);

Route::put('update/agenda', [AgendaController::class, 'editarAgenda']);

Route::put('update/admin', [AdministradorController::class, 'editarAdm']);

//--------------------------------------------------------------------------------------------------------------




//-----------------------------------------------Visualizar-----------------------------------------------------

Route::get('all/cliente', [ClienteController::class, 'retornarTodosClientes']);

Route::get('all/profissional', [ProfissionalController::class, 'retornarTodosProfissionais']);

Route::get('all/servico', [ServicoController::class, 'retornarTodosServicos']);

Route::get('all/agenda', [AgendaController::class, 'retornarTodosAgenda']);

Route::get('all/admin', [AdministradorController::class, 'retornarTodosAdm']);

//--------------------------------------------------------------------------------------------------------------




//--------------------------------------------------Excluir-----------------------------------------------------

Route::delete('excluir/cliente/{id}', [ClienteController::class, 'excluirCliente']);

Route::delete('excluir/profissional/{id}', [ProfissionalController::class, 'excluirProfissional']);

Route::delete('excluir/servico/{id}', [ServicoController::class, 'excluirServico']);

Route::delete('excluir/agenda/{id}', [AgendaController::class, 'excluirAgenda']);

Route::delete('excluir/admin/{id}', [AdministradorController::class, 'excluirAdm']);

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

Route::put ('recuperar/senha/admin', [AdministradorController::class, 'recuperarSenha']);

//------------------------------------------------------------------------------------------------------------




//login

Route::post('/create', [AdministradorController::class, 'store']);

Route::post('/login', [AdministradorController::class, 'login']);

Route::post('admin/teste', [AdministradorController::class, 'verificaUsuarioLogado'])->middleware(['auth:sanctum',
 SetSanctumGuard::class,
 VerifyAdminGuard::class,
 IsAuthenticated::class
]);