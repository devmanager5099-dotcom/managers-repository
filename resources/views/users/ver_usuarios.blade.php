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
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Data</th>
                        <th>Promover</th>
                        <th>Remover</th>
                    </tr>
                </thead>
                <tbody id="tabelaRegistros">
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->telefone }}</td>
                        <td>{{ $user->created_at }}</td>                        
                        <td><a href="{{route('promover', $user->id)}}" class="btn btn-primary btn-sm">Promover</a></td>
                        <th><a href="{{route('deletar', $user->id)}}" class="btn btn-danger btn-sm btn-excluir">Excluir</a></th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if (count($users) == 0)
                <div class="container">
                    <div class="alert alert-success">
                        <div class="text text-center">
                            Sem Usuarios cadastrados ainda.
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