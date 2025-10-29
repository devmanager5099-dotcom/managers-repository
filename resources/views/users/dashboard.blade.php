@extends('layout.app')

@section('style')
<link href="{{asset('css/bootstrap-icons.css')}}" rel="stylesheet">
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('css/dash.css') }}" rel="stylesheet">
@endsection

@section('content')
<main class="principal" id="principal">
  <aside class="blueside" id="blueside">
    <div class="menuhead1" id="menuhead1">
      <div class="pProfile" id="pProfile">
        <h2 class="pnome" id="pnome">{{ $user->name }}</h2>
        <img src="{{ asset('imagens/logo.jpg') }}" alt="User Logo" class="profile-img">
      </div>
    </div>
    

    <p class="dashtitu" id="dashtitu"><span></span>DASHBOARD</p>

    <nav class="linkscont" id="linkscont">
      <div class="icone"><a class="nav-link" href="{{ route('servicoForm') }}">Serviços</a></div>
      <div class="icone"><a class="nav-link" href="{{ route('verUsuarios') }}">Usuarios</a></div>
      <div class="icone"><a class="nav-link" href="{{ route('verPerguntas') }}">Perguntas</a></div>
      <div class="icone"><a class="nav-link" href="{{ route('projetoForm') }}">Projeto Novo</a></div>
      <div class="icone"><a class="nav-link" href="{{ route('verpedidos') }}">Pedidos</a></div>
    </nav>
  </aside>

  <section class="whiteside" id="whiteside">
    <div class="menuhead" id="menuhead">
      <div class="turmaP" id="turmaP">
        <p class="psearch" id="psearch"><span></span>🔎</p>
        <p class="pask" id="pask"><span></span>🔔</p>
        <p class="pmenu" id="pmenu"><span></span>0</p>
      </div>
    </div>

    <header class="cards" id="cards">
      <div class="card tras">
        <p>Usuarios</p>
        <h3>{{ $userCount }}+</h3>
      </div>

      <div class="card tras">
        <p>Perguntas</p>
        <h3>{{ $peguntas }}+</h3>
      </div>

      <div class="card tras">
        <p>Projetos</p>
        <h3>{{ $projetos }}+</h3>
      </div>

      <div class="card tras">
        <p>Pedidos</p>
        <h3>{{ $pedidos }}+</h3>
      </div>

      <div class="card tras">
        <p>Serviços</p>
        <h3>{{ $servicos }}+</h3>
      </div>
    </header>

    <main class="foot" id="foot">
      <div class="grafico" id="grafico">
        <!-- Insert chart or summary data here -->
      </div>
    </main>
  </section>
</main>

<script>

    const values = @json($dados);

const grafico = document.getElementById("grafico");

const maiorValor = values.reduce((maior,atual)=>{
              
    return atual.lenght > maior.lenght ? atual : maior;
});

values.forEach((valor) =>{
        
      if(maiorValor >= 200){
         const bar = document.createElement("div");
         bar.classList.add("bar");

         bar.style.height = (valor / 10)+10 + "px";
         bar.textContent = (valor / 10);
         grafico.appendChild(bar);

      }
      else if(maiorValor <= 10){
           const bar = document.createElement("div");
           bar.classList.add("bar");

           bar.style.height = (valor * 10)+10 + "px";
           bar.textContent = valor;
           grafico.appendChild(bar);
      }
      else{
          const bar = document.createElement("div");
          bar.classList.add("bar");

          bar.style.height = valor + "px";
          bar.textContent = valor;
          grafico.appendChild(bar);
      }
});


</script>

<script src="{{ asset('js/admdashboard.js') }}"></script>

@endsection