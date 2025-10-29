@extends('layout.app')
@section('style')
<link href="{{asset('css/bootstrap-icons.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
<style>
  #navbar{
       background-color: #f25f29;
       color: #2d3773;
  }
</style>
@endsection
@section('content')

  <!-- Conteúdo principal -->
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-8">
        @forelse($perguntas as $pergunta)
          <div class="card mb-4 shadow-sm">
          <div class="card-body">
            <div class="card-title">
                <p>{{$pergunta->created_at}}</p>
            </div>
            <p>{{ $pergunta->pergunta }}</p>
            <a href="{{ route('respostasFunc',$pergunta->id) }}" class="btn btn-primary"><i class="bi bi-file-earmark-code"></i>Responder</a>
            <a href="{{ route('eliminarPergunta',$pergunta->id) }}" class="btn btn-danger"><i class="bi bi-file-earmark-code"></i>Eliminar</a>
          </div>
        </div>
        @empty
          <div class="container">
            <div class="alert alert-success">
              <div class="text-center text-muted">Nenhuma Pergunta ainda</div>
            </div>
          </div>
        @endforelse
      </div>
  </div>

  @endsection