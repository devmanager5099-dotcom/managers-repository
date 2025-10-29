@extends('layout.app')
@section('style')
<link href="{{asset('css/bootstrap-icons.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
<style>
  header {
    background-color: #f29441;
    color: #2d3773;
    text-align: center;
    padding: 15px;
    border-radius: 6px;
    letter-spacing: 10px;
  }

  header h1{
    font-size: 32px
  }

  .card {
    max-width: 700px;
    margin: 20px auto;
    background: white;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
  }

  h2 {
    margin-top: 0;
    color: #333;
  }

  .comment {
    border-bottom: 1px solid #ddd;
    padding: 10px 0;
  }

  .comment:last-child {
    border-bottom: none;
  }

  .meta {
    color: #666;
    font-size: 13px;
    margin-bottom: 5px;
  }

  textarea {
    width: 100%;
    height: 80px;
    border: 1px solid #f29441;
    border-radius: 6px;
    padding: 8px;
    resize: none;
  }

  button {
    background-color: #2d3773;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 6px;
    margin-top: 8px;
    cursor: pointer;
  }

  button:hover {
    background-color: #f29441;
  }
</style>
@endsection

@section('content')
<header>
  <h1>{{$pedido->nome}}</h1>
</header>
<div class="card">
  <h2 style="color: #2d3773;">Mensagens</h2>

  <div id="commentsList">
    @forelse ($msgs as $msg)
    <div class="comment">
      <div class="meta"><strong style="color: #f25f29;">
        @if ($msg->user)
            {{ $msg->user->name}}
        @else
            {{ $msg->admin->name}}
        @endif  
      </strong> {{$msg->created_at}}</div>
      <div style="color: #2d3773;">{{$msg->msg}}</div>
    </div>
    @empty
    <div class="container">
      <div class="alert alert-success">
        <div class="text-center">
          Não há mensagens Ainda.
        </div>
      </div>
    </div>
    @endforelse
  </div>

  <form id="form" method="post" action="{{route('salvarMensagem', $pedido->id)}}">
    @csrf
    <textarea id="text" name="msg" placeholder="Digite a sua mensagem" required></textarea>
    <button type="submit">Enviar</button>
  </form>
</div>
@endsection