<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projeto;
use App\Models\Framework;
use App\Models\Comentarios;

class ProjetoController extends Controller
{
    // mostra formulário
    public function projetoForm()
    {
        return view('projetos.criar');
    }

    // salva projeto
   public function projetoFunc(Request $request)
{
    $validated = $request->validate([
        'nome' => 'required|string|max:255',
        'descricao' => 'nullable|string',
        'zip' => 'required|file|mimes:zip|max:10240', // 10 MB = 10240 KB
        'versao' => 'required',
        'linguagem' => 'required'
    ], [
        'zip.mimes' => 'O arquivo deve ser um ZIP.',
        'zip.max' => 'O arquivo ZIP não pode ultrapassar 10 MB.',
    ]);

    // Processa o arquivo ZIP
    $file = $request->file('zip');
    $filename = md5(now() . $file->getClientOriginalName()) . '.' . $file->extension();

    // Salva no disco 'public' em storage/app/public/projects
    $file->storeAs('projects', $filename, 'public');

    // Cria registro no banco
    $project = Projeto::create([
        'nome' => $validated['nome'],
        'descricao' => $validated['descricao'] ?? null,
        'zip' => $filename, // Apenas o nome, não o caminho completo
        'versao' => $validated['versao'],
        'linguagem' => $validated['linguagem']
    ]);

    return redirect()->route('frameworkForm', $project->id)
                     ->with('success', 'Projeto cadastrado com sucesso!');
}

    public function frameworkForm($projeto_id){

        $frameworks = Framework::where('projeto_id', $projeto_id)->orderBy('created_at', 'desc')->get();
        $projeto = Projeto::find($projeto_id);
        return view('projetos.framework', compact('frameworks', 'projeto'));
        
    }

    public function frameworkFunc(Request $request, $projeto_id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'version' => 'nullable|string|max:50',
            'desc' => 'required|string|max:255',
        ]);

        Framework::create([
            'name' => $validated['name'],
            'version' => $validated['version'],
            'desc' => $validated['desc'],
            'projeto_id'=>$projeto_id
        ]);

        return redirect()->back()->with('success', 'Framework adicionado com sucesso!');
    }

    public function salvarComentario(Request $request, $projeto_id){
        Comentarios::create([
            'comentario'=>$request->cometario,
            'user_id'=>Auth()->user()->id,
            'projeto_id'=>$projeto_id,
        ]);

        return redirect()->back();
    }

}
