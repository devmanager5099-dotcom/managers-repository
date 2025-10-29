@extends('layout.app')
@section('style')
<link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
@endsection
@section('content')

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
        <div class="mt-3 mt-md-0">
          <a href="{{ asset('upload/'.$projeto->zip) }}" class="btn btn-success me-2">
            <i class="bi bi-download"></i> Baixar .zip
          </a>
          <a href="#" class="btn btn-outline-light">
            <i class="bi bi-github"></i> Ver código
          </a>
        </div>
      </div>
    </div>
  </header>


<div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Frameworks ou Tecnologias da Aplicação</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#frameworkModal">
            Adicionar Framework
        </button>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Versão</th>
                <th>Criado em</th>
            </tr>
        </thead>
        <tbody>
            @forelse($frameworks as $fw)
                <tr>
                    <td>{{ $fw->id }}</td>
                    <td>{{ $fw->name }}</td>
                    <td>{{ $fw->version ?? '-' }}</td>
                    <td>{{ $fw->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Nenhum framework adicionado ainda</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Modal Bootstrap -->
    <div class="modal fade" id="frameworkModal" tabindex="-1" aria-labelledby="frameworkModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content shadow">
                <div class="modal-header">
                    <h5 class="modal-title" id="frameworkModalLabel">Adicionar Framework</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('frameworkFunc', $projeto->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome <span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                            @error('name') 
                                <small class="text-danger mt-2">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="version" class="form-label">Versão</label>
                            <input type="text" id="version" name="version" class="form-control" value="{{ old('version') }}">
                            @error('version') 
                                <small class="text-danger mt-2">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Descrição <span class="text-danger">*</span></label>
                            <input type="text" id="desc" name="desc" class="form-control" value="{{ old('desc') }}">
                            @error('desc') 
                                <small class="text-danger mt-2">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection