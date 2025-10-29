@extends('layout.app')

@section('style')
  <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/ask.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="container my-5">

    {{-- Exibir a pergunta principal --}}
    <div class="card shadow-sm mb-4">
      <div class="card-body text-center">
        <h5 class="card-title mb-3">
          <i class="bi bi-question-circle"></i> Pergunta
        </h5>
        <p class="card-text fs-5 fw-semibold">{{ $pergunta->pergunta }}</p>
      </div>
    </div>

    {{-- Listar respostas --}}
    @forelse ($respostas as $resposta)
      <div class="card shadow-sm mb-3">
        <div class="card-body">
          <h6 class="card-subtitle mb-2 text-muted">
            <i class="bi bi-clock"></i> {{ $resposta->created_at->format('d/m/Y H:i') }}
          </h6>
          <p class="card-text">{{ $resposta->resposta }}</p>
        </div>
      </div>
    @empty
      <div class="alert alert-warning text-center">
        <i class="bi bi-info-circle"></i> Nenhuma resposta ainda.
      </div>
    @endforelse

    {{-- Formulário para enviar resposta --}}
    <div class="card shadow-sm mt-5">
      <div class="card-body">
        <form action="{{ route('respostasFunc', $pergunta->id) }}" method="POST">
          @csrf
          <input type="hidden" name="pergunta_id" value="{{ $pergunta->id }}">

          <div class="mb-3">
            <label for="resposta" class="form-label fw-semibold">
              @if (Auth()->check() && Auth()->user()->is_admin)
                Sua resposta
              @else
                Outra pergunta ou comentário
              @endif
            </label>
            <textarea name="resposta" id="resposta" rows="4" class="form-control" required></textarea>
          </div>

          <div class="text-center">
            <button type="submit" class="btn btn-primary">
              <i class="bi bi-send"></i> Enviar
            </button>
          </div>

        </form>
      </div>
    </div>

  </div>
@endsection