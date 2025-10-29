@extends('layout.app')

@section('style')
<link href="{{asset('css/bootstrap-icons.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
<style>
  #navbar {
    background-color: #f25f29;
    color: #2d3773;
  }
</style>
@endsection

@section('content')

<div class="container mt-4">
  <div class="row">
    <!-- Área principal -->
    <div class="col-md-8">
      @forelse($projetos as $projeto)
      <div class="card mb-4 shadow-sm">
        <div class="card-body">
          <h3 class="card-title">{{ $projeto->nome}}</h3>
          <p>{{ $projeto->descricao }}</p>
          <a href="{{ route('detalhes', $projeto->id) }}" class="btn btn-primary">
            <i class="bi bi-file-earmark-code"></i> Ver detalhes
          </a>
          <a href="{{ asset('storage/projects/' . $projeto->zip) }}" class="btn btn-success">
            <i class="bi bi-download"></i> Exportar zip
          </a>
        </div>
      </div>
      @empty
      <div class="container">
        <div class="alert alert-success">
          <div class="text-center text-muted">Nenhum Projeto adicionado ainda</div>
        </div>
      </div>
      @endforelse
    </div>

    <!-- Sidebar -->
    <div class="col-md-4">
      <!-- Categorias -->
      <div class="card mb-4">
        <div class="card-header">Categorias</div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Programação em C</li>
          <li class="list-group-item">Java & Android</li>
          <li class="list-group-item">Python & Inteligência Artificial</li>
        </ul>
      </div>

      <!-- Sobre mim -->
      <div class="card mb-4">
        <div class="card-header">Sobre mim</div>
        <div class="card-body" id="sobre-mim">
          <p>Somos o grupo Dev Managers, estudantes de Engenharia de Computação em Angola, apaixonados por
            programação e criação de sistemas complexos.</p>
          <p>Nosso objetivo é investir em tecnologia, educação e entretenimento digital.</p>

          <!-- Dados dinâmicos da API -->
          <div id="api-dados" class="text-muted">
            <p>Carregando artigos de tecnologia...</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
// API do Dev.to: posts recentes sobre tecnologia
fetch('https://dev.to/api/articles?per_page=3&top=7')
  .then(response => response.json())
  .then(posts => {
    const container = document.getElementById('api-dados');
    if (posts.length === 0) {
      container.innerHTML = '<p>Nenhum artigo encontrado.</p>';
      return;
    }

    let html = '<h5>Últimos artigos de tecnologia:</h5>';
    posts.forEach(post => {
      html += `
        <div class="mb-3">
          <strong>${post.title}</strong><br>
          <small>por ${post.user.name}</small><br>
          <a href="${post.url}" target="_blank">Ler artigo</a>
        </div>
      `;
    });

    container.innerHTML = html;
  })
  .catch(err => {
    document.getElementById('api-dados').innerHTML =
      `<p class="text-danger">Erro ao carregar dados: ${err.message}</p>`;
  });
</script>

@endsection
