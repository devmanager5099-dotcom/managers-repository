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

<!-- Conteúdo principal -->
<div class="container mt-4">
    <div class="row">
        <!-- Área principal -->
        <div class="col-md-8">

            <!-- Projeto -->
            @forelse($perguntas as $pergunta)
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">{{ $pergunta->created_at}}</h3>
                    <p>{{ $pergunta->pergunta }}</p>
                    <a href="{{ route('respostasForm',$pergunta->id) }}" class="btn btn-primary"><i
                            class="bi bi-file-earmark-code"></i>Responder</a>
                    <a href="{{ route('eliminarPergunta', $pergunta->id) }}" class="btn btn-danger"><i
                            class="bi bi-delete"></i> Excluir</a>
                </div>
            </div>
            @empty
            <div class="container">
                <div class="alert alert-success">
                    <div class="text-center text-muted">Nenhuma pergunta adicionado ainda</div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

@endsection