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
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Usuario</th>
                        <th>Plataforma</th>
                        <th>Nome</th>
                        <th>Estado</th>
                        <th>Data</th>
                        <th>Chat</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody id="tabelaRegistros">
                    @foreach ($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->user->name }}</td>
                        <td>{{ $pedido->plataforma }}</td>
                        <td>{{ $pedido->nome }}</td>
                        <td>{{ $pedido->estado }}</td>
                        <td>{{ $pedido->created_at }}</td>
                        <td>
                            @if ($pedido->estado != 'Esperando')
                                <a href="{{ route('PedidoChat', $pedido->id) }}" class="btn btn-success btn-sm btn-excluir">Chat</a>
                            @else
                                <a href="{{ route('aceitarPedido', $pedido->id)  }}" class="btn btn-primary btn-sm btn-excluir">Aceitar</a>
                            @endif
                        </td>
                        <td>
                            <a href="" class="btn btn-danger btn-sm btn-excluir">Excluir</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if (count($pedidos) == 0)
                <div class="container">
                    <div class="alert alert-success">
                        <div class="text text-center">
                            Sem Pedidos cadastrados ainda.
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<button class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#frameworkModal">+</button>
<script src="{{asset('/js/visualizar.js')}}"></script>
@endsection