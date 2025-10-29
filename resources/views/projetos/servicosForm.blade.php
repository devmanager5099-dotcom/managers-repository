@extends('layout.app')
@section('title', 'Painel de Servicos')
@section('style')
<link href="{{asset('css/bootstrap-icons.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
<style>
  body {
    background-color: #f8f9fa;
  }

  .btn-add {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 60px;
    height: 60px;
    font-size: 28px;
    border-radius: 50%;
    padding: 0;
    z-index: 10;
  }

  #form-container {
    display: none;
    margin-bottom: 20px;
  }
</style>
@endsection
@section('content')
<div class="container py-4">

  <div class="modal fade" id="frameworkModal" tabindex="-1" aria-labelledby="frameworkModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content shadow">
        <div class="modal-header">
          <h5 class="modal-title" id="frameworkModalLabel">Adicionar Servico</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('servicoFunc') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Nome <span class="text-danger">*</span></label>
              <input type="text" id="name" name="nome" class="form-control" value="{{ old('name') }}">
              @error('name')
              <small class="text-danger mt-2">{{ $message }}</small>
              @enderror
            </div>
            <div class="mb-3">
              <label for="version" class="form-label">Duração</label>
              <input type="text" id="version" name="duracao" class="form-control" value="{{ old('duracao') }}">
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


<div class="card">
  <div class="card-body p-0">
    <table class="table table-striped mb-0">
      <thead class="table-light">
        <tr>
          <th>Nome</th>
          <th>Descricao</th>
          <th>Duracao</th>
          <th style="width: 80px;">Ações</th>
        </tr>
      </thead>
      <tbody id="tabelaRegistros">
        @for($i=0; count($servicos) > $i; $i++)
        <tr>
          <td>{{$servicos[$i]->nome}}</td>
          <td>{{$servicos[$i]->descricao}}</td>
          <td>{{$servicos[$i]->duracao}}</td>
          <td><a href="" class="btn btn-danger btn-sm btn-excluir">Excluir</a></td>
        </tr>
        @endfor
    </table>
  </div>
</div>
</div>

<button class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#frameworkModal">+</button>
<script src="{{asset('/js/visualizar.js')}}"></script>
@endsection