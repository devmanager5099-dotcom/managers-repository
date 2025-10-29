@extends('layout.app')
@section('style')
<link href="{{asset('css/bootstrap-icons.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap.min.csp')}}s" rel="stylesheet">
@endsection

@section('title', 'Painel de Visualização')

@section('content')
  <div class="container py-4">

    <h2 class="mb-4 text-primary">Sobre o Aplicativo</h2>

    <div class="card mb-4">
      <div class="card-header bg-primary text-white">
        Deixe seu comentário
      </div>
      <div class="card-body">
        <form id="formComentario"   action="{{route('comentario')}}" method="post">
          @csrf
          <div class="mb-3">
            <label for="comentarioTexto" class="form-label">Comentário</label>
            <textarea id="comentarioTexto" name="comentarioTexto" class="form-control" rows="4" placeholder="Digite seu comentário" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
        </div>
    </div>

    <div class="card">
      <div class="card-header bg-secondary text-white">
        Detalhes Técnicos
      </div>
      <div class="card-body">
        <ul>
          <li><strong>Versão:</strong> 1.0.0</li>
          <li><strong>Tecnologias:</strong> HTML5, CSS3, JavaScript, Bootstrap 5</li>
          <li><strong>Backend:</strong>Laravel</li>
          <li><strong>Última atualização:</strong> 17 de agosto de 2025</li>
        </ul>
      </div>
    </div>
  </div>
@endsection
