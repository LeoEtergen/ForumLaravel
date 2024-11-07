@extends('layouts.gpt')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/postagens_por_tag.css') }}">
    Postagens com a Tag: {{ $tag->name }}
@endsection

@section('content')
    <div class="container">
        <div class="header">
            <div class="login-buttons">
                @if(Auth::check())
                    <div class="dropdown">
                        <button class="dropbtn">Olá, {{ Auth::user()->name }}</button>
                        <div class="dropdown-content">
                            <a href="{{ route('listUser', ['uid' => Auth::user()->id]) }}">Editar</a>
                            <a href="{{ route('logout') }}">Sair</a>
                        </div>
                    </div>
                @else
                    <a href="{{ route('register') }}"><button class="register-button">Registrar</button></a>
                    <a href="{{ route('login') }}"><button class="register-button">Login</button></a>
                @endif
            </div>
        </div>

        @if ($postagens->isEmpty())
            <p>Nenhuma postagem encontrada com esta tag.</p>
        @else
            <div class="postagens-container">
                @foreach($postagens as $postagem)
                    <div class="postagem-card">
                        <h3>{{ $postagem->titulo }}</h3>
                        <p>{{ $postagem->conteudo }}</p>
                        @if ($postagem->user)
                            <p>Autor: {{ $postagem->user->name }}</p>
                        @else
                            <p>Autor desconhecido</p>
                        @endif
                        @if ($postagem->tags)
                            <p>Tags:
                                @foreach($postagem->tags as $tag)
                                    <span class="tag">{{ $tag->name }}</span>
                                @endforeach
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        <a href="{{ route('postagem.create') }}"><button class="btn-criar">Criar nova postagem</button></a>
    </div>
@endsection
