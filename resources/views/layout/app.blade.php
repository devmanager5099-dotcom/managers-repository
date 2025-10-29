<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  @yield('style')
  <title>@yield('title')</title>
</head>

<body>

  <nav class="navbar">
    <div class="logo">
      <h1>
        <img style="width: 200px; height: auto; background-color: #f4f4f9;" src="{{asset('imagens/logo.jpg')}}">
      </h1>
    </div>
    <div class="menu">
      @if(auth()->guest())
        <a href="{{ route('home') }}">Home</a>
        <a id="btn" href="{{ route('perguntasForm') }}">Deixe Sua Questão</a>
      @else
        @if (auth()->user()->is_admin)
          <a href="{{ route('admin') }}">Painel</a>
        @endif
        @if (Auth()->check())
          <a class="navbar-brand" href="#">{{ auth()->user()->name }} </a>
          <a href="{{ route('home') }}">Home</a>
          <a href="{{ route('pedidos') }}">Pedidos</a>
          <a href="{{ route('perguntasForm') }}">Respostas</a>
          <a href="{{ route('servicos') }}" style="color: #2d3773">Servicos</a>
          <a id="logOut" href="#">Sair</a>

          <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

          <!-- Seu script que usa SweetAlert2 -->
          <script>
            const logOut = document.getElementById('logOut');

              logOut.addEventListener('click', (e) => {

                e.preventDefault();
                Swal.fire({
                  title: 'Tem certeza?',
                  text: 'Pretende mesmo sair?',
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Sim, sair',
                  cancelButtonText: 'Cancelar'
                })
                  .then((result) => {

                    if (result.isConfirmed) {
                      window.location.href = "{{ route('logout') }}";
                    }
                  });

              });
          </script>


        @endif
      @endif
    </div>
  </nav>

  @yield('content')
  <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>