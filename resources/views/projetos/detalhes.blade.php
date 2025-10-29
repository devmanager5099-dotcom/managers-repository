@extends('layout.app')
@section('style')
<link href="{{asset('css/bootstrap-icons.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<!-- Header do Projeto -->
<header class="bg-dark text-white py-4">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-2">
        <li class="breadcrumb-item active text-white" aria-current="page">Nome do Projeto</li>
      </ol>
    </nav>
    <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-between">
      <div>
        <h1 class="h2 mb-1">{{ $projeto->nome }}</h1>
        <p class="mb-0 opacity-75">{{ $projeto->descricao }}</p>
      </div>
    </div>
  </div>
</header>

<main class="container my-5">
  <div class="row g-4">
    <!-- Coluna principal -->
    <div class="col-lg-8">
      <!-- Tecnologias -->
      <section class="card shadow-sm mb-4">
        <div class="card-body">
          <h2 class="h5 mb-3"><i class="bi bi-cpu"></i> Tecnologias e frameworks</h2>
          <div class="d-flex flex-wrap gap-2">
            <span class="badge text-bg-success">{{ $projeto->linguagem }}</span>
            @foreach ($frameworks as $fw)
            <span class="badge text-bg-success">{{ $fw['name'] }}</span>
            @endforeach
          </div>
        </div>
      </section>

      <!-- Requisitos -->
      <section class="card shadow-sm mb-4">
        <div class="card-body">
          <h2 class="h5 mb-3"><i class="bi bi-clipboard-check"></i> Requisitos</h2>
          <div class="table-responsive">
            <table class="table align-middle">
              <thead>
                <tr>
                  <th scope="col">Nome</th>
                  <th scope="col">Versão</th>
                  <th scope="col">Observações</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($frameworks as $fw)
                <tr>
                  <td>{{ $fw['name'] }}</td>
                  <td>{{ $fw['version'] }}</td>
                  <td>{{ $fw['desc'] }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- Comentários -->
      <section class="card shadow-sm mb-4" id="comentarios">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h5 mb-0"><i class="bi bi-chat-dots"></i> Comentários</h2>
            <span class="badge text-bg-secondary">{{ count($comentarios) }}</span>
          </div>


          <div class="list-group mb-4">
            @forelse ($comentarios as $comentario)
            <div class="list-group-item">
              <div class="d-flex justify-content-between">
                <strong>{{ $comentario->user->name }}</strong>
                <small class="text-muted">{{ $comentario->created_at }}</small>
              </div>
              <p class="mb-1">{{ $comentario->comentario }}</p>
            </div>
            @empty
            <div class="list-group-item">
              <div class="alert alert-primary">
                <div class="text-center">
                  Sem comentarios ainda.
                </div>
              </div>
            </div>
            @endforelse

          </div>

          <!-- Formulário de comentário -->
          <h3 class="h6 mb-3">Deixar um comentário</h3>
          <form action="{{ route('comentar', $projeto->id) }}" method="post" class="needs-validation" novalidate>
            @csrf
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label">Comentário</label>
                <textarea name="cometario" rows="4" class="form-control" required></textarea>
                <div class="invalid-feedback">Escreva seu comentário.</div>
              </div>
              <div class="col-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                  <i class="bi bi-send"></i> Publicar
                </button>
              </div>
            </div>
          </form>
        </div>
      </section>
    </div>

    <!-- Coluna lateral -->
    <aside class="col-lg-4">
      <!-- Card de Download -->
      <div class="card shadow-sm mb-4">
        <div class="card-body">
          <h2 class="h6 mb-3"><i class="bi bi-box-arrow-down"></i> Download</h2>
          <p class="small text-muted mb-3">Baixe a versão mais recente do projeto em formato .zip.</p>
          <a href="#" class="btn btn-success w-100 mb-2"><i class="bi bi-download"></i> Baixar .zip</a>
          <a href="#" class="btn btn-outline-secondary w-100"><i class="bi bi-arrow-repeat"></i>Ver codigo </a>
        </div>
      </div>

      <!-- Informações rápidas -->
      <div class="card shadow-sm mb-4">
        <div class="card-body">
          <h2 class="h6 mb-3"><i class="bi bi-card-checklist"></i> Info rápida</h2>
          <ul class="list-unstyled mb-0">
            <li class="mb-2"><i class="bi bi-hash"></i> Versão: 1.0.0</li>
            <li class="mb-2"><i class="bi bi-calendar-event"></i> Atualizado: 25/08/2025</li>
            <li class="mb-2"><i class="bi bi-person"></i> Autor: Abílio Severino José</li>
            <li class="mb-2"><i class="bi bi-license"></i> Licença: MIT</li>
          </ul>
        </div>
      </div>

      <!-- Tecnologias (repetição visual) -->
      <div class="card shadow-sm">
        <div class="card-body">
          <h2 class="h6 mb-3"><i class="bi bi-tags"></i> Stack</h2>
          <div class="d-flex flex-wrap gap-2">
            <span class="badge rounded-pill text-bg-dark">Laravel</span>
            <span class="badge rounded-pill text-bg-primary">Bootstrap</span>
            <span class="badge rounded-pill text-bg-secondary">MySQL</span>
            <span class="badge rounded-pill text-bg-info">Redis</span>
          </div>
        </div>
      </div>
    </aside>
  </div>
</main>
@endsection