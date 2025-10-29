<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>

<div class="login">
    <form action="{{ route('login.func') }}" method="post">
        @csrf
        <h1>Login</h1>

        <!-- Mensagens de sucesso ou erro -->
        @if(session('erro'))
            <p style="color:red; text-align:center;">{{ session('erro') }}</p>
        @endif
        @if(session('sucesso'))
            <p style="color:green; text-align:center;">{{ session('sucesso') }}</p>
        @endif

        <input type="email" id="E-mail" name="email" placeholder="E-mail" required>
        <input type="password" id="Senha" name="password" placeholder="Senha" required>
        <button type="submit">Entrar</button>

        <p style="text-align: center; margin-top: 14px;">
            Não tem uma conta? <a href="{{ route('cadastro.form') }}">Cadastre-se!</a>
        </p>
    </form>
</div>  
</body>
</html>
