@extends('layout.app')
@section('style')
<link href="{{asset('css/bootstrap-icons.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('css/cards.css')}}" rel="stylesheet">
@endsection
@section('content')


<div class="container-servicos">
    @forelse ($servicos as $servico)
    <div class="card">
        <div class="content">
            <h3>{{$servico->nome}}</h3>
            <h4>Descrição: <span style="color: #666;">{{$servico->descricao}}</span></h4>
            <h4 style="margin-bottom: 1%;">Duraçao: {{$servico->duracao}}</h4>
            <a href="{{ route('reservar', $servico->id) }}"><button>Reserva</button></a>
            <a href="{{ route('servicosComentarios', $servico->id)}}"><button style="color: aliceblue; border-radius: 3px; font-size: medium;margin-left: 5px;">
                Comentários</button> </a>
            
        </div>
    </div>
    @empty
        <div class="card">
            Sem Serviços cadastrados ainda.
        </div>
    @endforelse
</div>


@endsection