@extends('layout.app')

@section('style')
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
@endsection

@section('content')

    <header class="head">
        <div class="headline">
            <h2 class="main-title">Você achou a solução</h2>
            <h2 style=" font-size: 35px;" class="subtitle">tecnológica para a sua empresa.</h2>
            <h2 class="subtitle">Fazemos a criação de sites, aplicativos para computadores e smartphones. Desde softwares de
                gestao ate plataformas para publicitar o seu negocio! Garantimos a sua presença digital. </h2>
            <p class="autor">Maneger Devs</p>
            <p class="quote">"O que mais dói não é o que fizemos, mas o que deixamos de fazer." – C. Bukowski</p>
            <a href="{{ route('login.form') }}" id="cadasbtn" class="contact-btn">Cadastre-se Agora</a>
        </div>
        <div class="img-head">
            <img src="{{ asset('imagens/banner.jpg') }}" alt="Ilustração" style="max-width: 100%;">
        </div>
    </header>

    <section style="  background-color: white;" class="servico-section">
        <h2>O que Podemos Fazer Pelo Seu Negócio</h2>
        <div style="height: 50%; width: 100%;" class="servicos">
            <!-- Card 1 -->
            <div class="card">
                <img src="{{ asset('imagens/coding.png') }}" alt="Coding">
                <h3>Apps Desktop</h3>
                <p>Gerenciar internamente nunca foi tão fácil.</p>
                <div class="texto-oculto">
                    <h3>Detalhes</h3>
                    <p>Aplicativos de gestão para computadores. De softwares de faturamento a soluções personalizadas.</p>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="card">
                <img src="{{ asset('imagens/mobile-development.png') }}" alt="Mobile Dev">
                <h3>Apps Mobile</h3>
                <p>Seu assistente pessoal na palma da mão.</p>
                <div class="texto-oculto">
                    <h3>Detalhes</h3>
                    <p>Aplicativos personalizados da sua empresa disponíveis em dispositivos móveis.</p>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="card">
                <img src="{{ asset('imagens/world-wide-web.png') }}" alt="Web Dev">
                <h3>Sites Responsivos</h3>
                <p>Levamos sua empresa ao mundo digital.</p>
                <div class="texto-oculto">
                    <h3>Detalhes</h3>
                    <p>Sites modernos, escaláveis e elegantes. Impressione seus clientes com presença online.</p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="logo-rodape">
            <h1 class="agencia"><img src="img/logo.jpg" alt="Logo" style="width: 100px;"></h1>
            <p style="color: white;">Uma criação de Maneger Devs</p>
        </div>
        <p style="color: white; margin-top: 50px;">© Todos os direitos reservados</p>
    </footer>

    <a target="_blank" class="whats" href="https://wa.link/zq932m">
        <img height="48px" width="48px" src="{{ asset('imagens/pinkw.jpg') }}" alt="WhatsApp">
    </a>

    @php
        // Se não existe um marcador de "visitado", é a primeira requisição
        $primeiraRequisicao = !session()->has('visitado');

        // Marca que o usuário já fez pelo menos uma requisição
        session(['visitado' => true]);
    @endphp

    @if ($primeiraRequisicao)
        <script>

            window.addEventListener("load", () => {
                setTimeout(function () {

                    let inicialPosi = 0;
                    const final = 800;

                    const passo = 1;
                    const intervalo = 30;

                    const scrollInterval = setInterval(function () {

                        window.scrollTo(0, inicialPosi);

                        inicialPosi += passo;

                        if (inicialPosi >= final) {
                            clearInterval(scrollInterval);
                        }
                    }, intervalo);



                }, 2000);

            });
        </script>
    @endif

@endsection