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
                    <h5 class="modal-title" id="frameworkModalLabel">Adicionar Pedido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('salvarPedido') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Plataforma <span class="text-danger">*</span></label>
                            <select class="form-control" name="plataforma" id="plataforma">
                                <option value="Mobile" selected>Mobile</option>
                                <option value="Desktop">Desktop</option>
                                <option value="Web">Web</option>
                                <option value="Cloud">Cloud</option>
                            </select>
                            @error('plataforma')
                            <small class="text-danger mt-2">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Serviço <span class="text-danger">*</span></label>
                            <select class="form-control" name="servico" id="servico">
                                @foreach ($servicos as $servico)
                                    @if ($servico_id == $servico->id)
                                        <option value="{{$servico->id}}" selected>{{$servico->nome}}</option>
                                    @else
                                        <option value="{{$servico->id}}">{{$servico->nome}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('servico')
                            <small class="text-danger mt-2">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="version" class="form-label">Nome</label>
                            <input type="text" id="nome" name="nome" class="form-control" value="{{ old('duracao') }}">
                            @error('nome')
                            <small class="text-danger mt-2">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Descrição <span class="text-danger">*</span></label>
                            <textarea id="descricao" name="descricao" class="form-control" value="{{ old('desc') }}" cols="30" rows="10"></textarea>
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
                        <td>{{ $pedido->plataforma }}</td>
                        <td>{{ $pedido->nome }}</td>
                        <td>{{ $pedido->estado }}</td>
                        <td>{{ $pedido->created_at }}</td>
                        <td>
                             @if ($pedido->estado == 'Esperando')
                                Chat não dissponivel ainda.
                             @else
                                 <a href="{{ route('PedidoChat', $pedido->id) }}" class="btn btn-success btn-sm btn-excluir">Chat</a>
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