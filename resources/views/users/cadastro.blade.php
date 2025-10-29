<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="cadastro">
        <form action="{{ route('cadastro.func') }}" method="POST">
            @csrf
            <h2 style="text-align: center;">Cadastre-se</h2>

            <!-- Mensagem de erro -->
            @if(session('erro'))
                <p style="color:red; text-align:center;">{{ session('erro') }}</p>
            @endif

            <input type="text" id="Nome" name="name" placeholder="Nome" required>
            <input type="email" id="E-mail" name="email" placeholder="E-mail" required>
            <input type="password" id="Senha" name="password" placeholder="Senha" required>
            <input type="number" id="Telefone" name="telefone" placeholder="Telefone" required>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>
