<?php

namespace App\Http\Controllers;

use App\Models\Pergunta;
use App\Models\Resposta;
use Illuminate\Http\Request;

class PerguntasController extends Controller
{

    public function perguntas(){
        $perguntas = Pergunta::all();
        return view('home.perguntas')->with('perguntas', $perguntas);
    }

    public function Verperguntas(){
        $perguntas = Pergunta::all();
        return view('users.ver_perguntas')->with('perguntas', $perguntas);
    }

    public function eliminar($id){
        $pergunta = Pergunta::find($id);
        $pergunta->delete();
        return redirect()->back();
    }

    public function salvarRespota(Request $request, $id){
        Resposta::create([
            'resposta'=>$request->resposta,
            'pergunta_id'=>$id
        ]);
        return redirect()->back();
    }

    public function perguntasForm()
    {
        $perguntas = Pergunta::all();
        return view('projetos.perguntas')->with('perguntas', $perguntas);
    }

    public function respostas($id)
    {
        $pergunta = Pergunta::find($id);
        $respostas = Resposta::where('pergunta_id', $id)->get();
        return view('home.resposta')->with('pergunta', $pergunta)->with('respostas', $respostas);
    }

    public function salvarPergunta(Request $request)
    {        
        $data = $request->all();
        Pergunta::create([
            'pergunta' => $data['pergunta'],
            'vista'=>false,
        ]);

        return redirect()->back();
    }
}
