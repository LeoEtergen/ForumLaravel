@extends('layouts.header')

@section('content')
<header>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</header>

<div class="container">
    <br><br>
    <div class="container containerWelcome">
        <div class="text">
            <h1 class="TituloWelcome">Bem-vindo ao Fórum!</h1>
            <p>
                Participe da nossa comunidade e explore diversos tópicos
                que conectam pessoas com interesses em comum.
            </p>
        </div>
    </div>
    <br><br>

    <div class="container">
        <h2>Categorias</h2>
        <div class="category-grid">
            <div class="card">Jogos</div>
            <div class="card">Animes</div>
            <div class="card">Filmes</div>
            <div class="card">Viagem</div>
            <div class="card">Moda</div>
            <div class="card">Esporte</div>
        </div>
    </div>
</div>
@endsection