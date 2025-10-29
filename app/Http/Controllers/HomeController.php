<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicos;
use App\Models\Projeto;
use App\Models\Framework;
use App\Models\Pedido;
use App\Models\User;
use App\Models\Pergunta;
use App\Models\Comentarios;
use App\Models\PedidoChat;

class HomeController
{
    public function home(){
        $projetos = Projeto::all();
        return view("home.home")->with('projetos', $projetos);
    }

    
    public function admin(){
        $user = Auth()->user();
        $userCount = count(User::all());
        $pedidos = count(Pedido::all());
        $peguntas = count(Pergunta::all());
        $projetos = count(Projeto::all());
        $servicos = count(Servicos::all());
        $dados = array($userCount, $pedidos, $peguntas, $projetos, $servicos);
        return view('users.dashboard')->with('user', $user)
            ->with('userCount', $userCount)
            ->with('pedidos', $pedidos)
            ->with('peguntas', $peguntas)
            ->with('projetos', $projetos)
            ->with('servicos', $servicos)
            ->with('dados', $dados);
    }

    public function verPedidos(){
        $pedidos = Pedido::all();
        return view('users.pedidos')->with('pedidos', $pedidos);
    }

    public function aceitarPedido($id){
        $pedido = Pedido::findOrFail($id);
        $pedido->estado = 'Aceite';
        $pedido->admin_id = Auth()->user()->id;
        $pedido->update();

        return redirect()->route('PedidoChat', $pedido->id);
    }

    public function PedidoChat($id){
        $pedido = Pedido::findOrFail($id);
        $msgs = PedidoChat::where('pedido_id', $pedido->id)
            ->get();

        return view('users.chat')->with('pedido', $pedido)->with('msgs', $msgs);
    }

    public function salvarMensagem(Request $request, $id){
        $pedido = Pedido::findOrFail($id);
        PedidoChat::create([
            'msg'=>$request->msg, 
            'pedido_id'=>$id, 
            'user_id'=>Auth()->user()->id,
        ]);
        return redirect()->back();
    }

    public function  servicos(){
        $servicos = Servicos::all();
        return view('home.servicos')->with('servicos', $servicos);
    }

    public function verUsuarios(){
        $users = User::where('is_admin', false)->get();
        return view('users.ver_usuarios')->with('users', $users);
    }

    
    public function promover($id){
        $user = User::findOrFail($id);
        $user->is_admin = true;
        $user->update();
        return redirect()->back();
    }

    public function deletar($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back();
    }


    public function detalhes($id){
        $frameworks = Framework::where('projeto_id', $id)
        ->distinct()
        ->orderBy('created_at', 'desc')
        ->get();
        $frameworks = $frameworks->toArray();
        $projeto = Projeto::find($id);
        $comentarios = Comentarios::where('projeto_id', $id)->orderBy('created_at', 'desc')->with('user')->get();
        return view('projetos.detalhes',  compact('frameworks', 'projeto', 'comentarios'));
    }

    public function servicoForm(){
        $servicos = Servicos::all();
        if(Auth()->user()->is_admin)
            return view('projetos.servicosForm')->with('servicos', $servicos);
        return view('projetos.servicos')->with('servicos', $servicos);
    }

    public function servicoFunc(Request $request){
        Servicos::create([
            'nome'=>$request->nome,
            'descricao'=>$request->desc,
            'duracao'=>$request->duracao,
        ]);
        return redirect()->back();
    }

    public function reservaServico($servico_id){
        return redirect()->route('pedidos',$servico_id);
    }

    public function servicosComentarios($id){
         $servico = Servicos::findOrFail($id);
         $comentarios = Comentarios::where('projeto_id', $id)->get();
        return view('projetos.comentarios')->with('servico', $servico)->with('comentarios', $comentarios);
    }

    public function cometarServico(Request $request, $id){
        Comentarios::create([
            'comentario'=>$request->comentario,
            'projeto_id'=>$id,
            'user_id'=>Auth()->user()->id,
        ]);
        return redirect()->back();
    }

    public function pedidos($servico_id = 0){
        $pedidos = Pedido::where('user_id', Auth()->user()->id)->get();
        $servicos = Servicos::all();
        return view('projetos.agendarServico')->with('pedidos', $pedidos)->with('servicos', $servicos)->with('servico_id', $servico_id);
    }

    public function SalvarPedido(Request $request){
        Pedido::create([
            'plataforma'=>$request->plataforma, 
            'nome'=>$request->nome,
            'estado'=>'Esperando',
            'servico_id'=>$request->servico,
            'descricao'=>$request->descricao, 
            'user_id'=>Auth()->user()->id,
        ]);

        return redirect()->back();
    }
}