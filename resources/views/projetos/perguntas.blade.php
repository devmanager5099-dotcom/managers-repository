@extends('layout.app')

@section('style')
<link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/ask.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="principal container">
    <div class="row justify-content-center align-items-start g-4">

        {{-- Quadro de pergunta --}}
        <div class="col-12 col-md-6">
            <form action="{{ route('perguntasFunc') }}" method="post" class="w-100">
                @csrf
                <div class="quadro">
                    <input class="ask form-control" type="text" name="pergunta" placeholder="Faça uma questão..." required>
                    <button class="btn mt-3">Enviar</button>
                </div>
            </form>
        </div>

        {{-- Lista de dúvidas --}}
        <div class="col-12 col-md-5">
            <div class="duv">
                <h2><b>Perguntas alternativas...</b></h2>
                <ul class="list-unstyled mt-3">
                    @forelse ($perguntas as $pergunta)
                        <li class="mb-2">
                            <a href="{{ route('respostasForm', $pergunta->id) }}">
                                {{ $pergunta->pergunta }}
                            </a>
                        </li>
                    @empty
                        <li>Sem perguntas até o momento.</li>
                    @endforelse
                </ul>
            </div>
        </div>

    </div>
</div>
@endsection
