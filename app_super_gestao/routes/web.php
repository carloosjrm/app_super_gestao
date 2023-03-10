<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProdutoDetalheController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PedidoProdutoController;
use App\Http\Middleware\LogAcessoMiddleware;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[PrincipalController::class,'principal'])->name('site.index')->middleware('log.acesso');
Route::get('/sobre-nos',[SobreNosController::class,'sobreNos'])->name('site.sobrenos');
Route::get('/contato',[ContatoController::class,'contato'])->name('site.contato');
Route::post('/contato',[ContatoController::class,'salvar'])->name('site.contato.post');

Route::get('/login/{erro?}', [LoginController::class,'index'])->name('site.login');
Route::post('/login', [LoginController::class,'autenticar'])->name('site.login.post');

Route::middleware('autenticacao:padrao,visitante')->prefix('/app')->group(function(){
    Route::get('/home', [HomeController::class,'index'])->name('app.home');
    Route::get('/sair', [LoginController::class,'sair'])->name('app.sair');
    //fornecedores
    Route::get('/fornecedor', [FornecedorController::class,'index'])->name('app.fornecedor');
    Route::post('/fornecedor/listar', [FornecedorController::class,'listar'])->name('app.fornecedor.listar.post');
    Route::get('/fornecedor/listar', [FornecedorController::class,'listar'])->name('app.fornecedor.listar');
    Route::get('/fornecedor/adicionar', [FornecedorController::class,'adicionar'])->name('app.fornecedor.adicionar');
    Route::post('/fornecedor/adicionar', [FornecedorController::class,'adicionar'])->name('app.fornecedor.adicionar.post');
    Route::get('/fornecedor/editar/{id}/{msg?}', [FornecedorController::class,'editar'])->name('app.fornecedor.editar');
    Route::get('/fornecedor/excluir/{id}', [FornecedorController::class,'excluir'])->name('app.fornecedor.excluir');
    //produtos
    Route::resource('produto', ProdutoController::class);
    //produtos_detalhes
    Route::resource('produto_detalhe',ProdutoDetalheController::class);

    Route::resource('cliente', ClienteController::class);
    Route::resource('pedido', PedidoController::class);
    Route::get('pedido-produto/create/{pedido}', [PedidoProdutoController::class,'create'])->name('pedido-produto.create');
    Route::post('pedido-produto/store/{pedido}', [PedidoProdutoController::class,'store'])->name('pedido-produto.store.post');
});

Route::fallback(function(){
    echo 'A rota acessada não existe. <a href="'.route('site.index').'">clique aqui</a> para a pagina inicial';
});
