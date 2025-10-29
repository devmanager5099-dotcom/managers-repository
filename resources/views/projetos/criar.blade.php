@extends('layout.app')
@section('style')
<link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
@endsection
@section('content')

  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-sm">
          <div class="card-header">
            <h5 class="mb-0">Cadastro de Projeto</h5>
          </div>
          <div class="card-body">
            @if(session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form action="{{ route('projetoFunc') }}" method="POST" enctype="multipart/form-data">
              @csrf
              
              <div class="mb-3">
                <label for="linguagem" class="form-label">Linguagem do Projeto <span class="text-danger">*</span></label>
                <select id="linguagem" name="linguagem" class="form-control" value="{{ old('liguagem') }}" required>
                  <option value="Java">Java</option>
                  <option value="C#">C#</option>
                  <option value="Python">Python</option>
                  <option value="JavaScript">JavaScript</option>
                  <option value="C/C++">C/C++</option>
                  <option value="Ruby">Ruby</option>
                  <option value="GO">Golang</option>
                  <option value="Rust">Rust</option>
                  <option value="Kotlin">Kotlin</option>
                  <option value="Dart">Dart</option>
                  <option value="PHP">PHP</option>
                  <option value="NodeJs">NodeJs</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="nome" class="form-label">Nome do Projeto <span class="text-danger">*</span></label>
                <input type="text" id="nome" name="nome" class="form-control" value="{{ old('nome') }}" required maxlength="255">
              </div>

              <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea id="descricao" name="descricao" class="form-control" rows="4">{{ old('descricao') }}</textarea>
              </div>

              <div class="mb-3">
                <label for="versao" class="form-label">Versão</label>
                <input id="versao" name="versao" class="form-control" value="{{ old('versao') }}">
              </div>

              <div class="mb-3">
                <label for="zip" class="form-label">Arquivo ZIP <span class="text-danger">*</span></label>
                <input class="form-control" type="file" id="zip" name="zip" accept=".zip,application/zip" required>
                <div class="form-text">Apenas arquivos .zip. Tamanho máximo: 10 MB.</div>
              </div>

              <div class="d-flex justify-content-end">
                <a href="#" class="btn btn-secondary me-2" onclick="history.back(); return false;">Cancelar</a>
                <button type="submit" class="btn btn-primary">Salvar Projeto</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection