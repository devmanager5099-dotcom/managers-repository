<?php

use App\Http\Controllers\PerguntasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\ProjetoController;

Route::get('/', function(){
    return view('index');
})->name('index');

Route::prefix('users')->group(function(){
    Route::get('/cadastro', [AuthController::class, 'cadastroForm'])->name('cadastro.form');
    Route::post('/cadastrar/usuario', [AuthController::class, 'cadastroFunc'])->name('cadastro.func');
    Route::post('/login', [AuthController::class,'loginFunc'])->name('login.func');
    Route::get('/login', [AuthController::class,'loginForm'])->name('login.form');
    Route::get('/logout', [AuthController::class,'logout'])->name('logout');
});

Route::middleware(UserMiddleware::class)->prefix('home')->group(function(){
    Route::get('/', [HomeController::class, 'home'])->name('home');

    Route::get('/admin', [HomeController::class, 'admin'])->name('admin');
    Route::get('/ver/pedidos', [HomeController::class, 'verPedidos'])->name('verpedidos');
    Route::get('/pedido/aceitar/{id}', [HomeController::class, 'aceitarPedido'])->name('aceitarPedido');
    Route::get('/pedido/chat/{id}', [HomeController::class, 'PedidoChat'])->name('PedidoChat');
    Route::post('/chat/savar/{id}', [HomeController::class, 'salvarMensagem'])->name('salvarMensagem');
    Route::get('/users/ver', [HomeController::class, 'verUsuarios'])->name('verUsuarios');
    Route::get('/users/promover/user/{id}', [HomeController::class, 'promover'])->name('promover');
    Route::get('/users/deletar/user/{id}', [HomeController::class, 'deletar'])->name('deletar');
    Route::get('/users/promover/user/{id}', [HomeController::class, 'promover'])->name('promover');
    Route::get('/users/deletar/user/{id}', [HomeController::class, 'deletar'])->name('deletar');
        

    Route::group(['prefix'=> 'devmanagers'], function(){
        Route::get('/detalhes/{id}', [HomeController::class, 'detalhes'])->name('detalhes');
        Route::get('/servicos', [HomeController::class, 'servicos'])->name('servicos');
        Route::get('/servicos/comentarios/{id}', [HomeController::class, 'servicosComentarios'])->name('servicosComentarios');
        Route::post('/servicos/comentarios/{id}', [HomeController::class, 'cometarServico'])->name('cometarServico');
        Route::get('/servicos/cadastro', [HomeController::class, 'servicoForm'])->name('servicoForm');
        Route::post('/servicos/cadastro', [HomeController::class, 'servicoFunc'])->name('servicoFunc');
    });

    Route::group(['prefix'=> 'pedidos'], function(){
        Route::get('/', [HomeController::class, 'pedidos'])->name('pedidos');
        Route::post('/salvar/pedido', [HomeController::class, 'SalvarPedido'])->name('salvarPedido');
        Route::get('/servicos/reservar/{servico_id}', [HomeController::class, 'reservaServico'])->name('reservar');
    });
});

Route::middleware(UserMiddleware::class)->prefix('pojetos')->group(function(){
    Route::get('/criar/projeto', [ProjetoController::class, 'projetoForm'])->name('projetoForm');
    Route::post('/criar/projeto', [ProjetoController::class, 'projetoFunc'])->name('projetoFunc');
    Route::get('/frameworks/{id}', [ProjetoController::class, 'frameworkForm'])->name('frameworkForm');
    Route::post('/frameworks/{id}', [ProjetoController::class, 'frameworkFunc'])->name('frameworkFunc');
    Route::post('/projetos/comentar/{projeto_id}', [ProjetoController::class, 'salvarComentario'])->name('comentar');
});

Route::group(['prefix'=> 'chat'], function(){
    Route::get('/perguntas', [PerguntasController::class, 'perguntas'])->name('perguntas');
    Route::get('/perguntas', [PerguntasController::class, 'Verperguntas'])->name('verPerguntas');
    Route::get('/perguntas/eliminar/{id}', [PerguntasController::class, 'eliminar'])->name('eliminarPergunta');
    Route::get('/pergunta/nova', [PerguntasController::class, 'perguntasForm'])->name('perguntasForm');
    Route::post('/salvar/pergunta', [PerguntasController::class, 'salvarPergunta'])->name('perguntasFunc');
    Route::get('/respostas/{id}', [PerguntasController::class, 'respostas'])->name('respostasForm');
    Route::post('/respostas/{id}', [PerguntasController::class, 'salvarRespota'])->name('respostasFunc');
});
