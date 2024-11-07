@extends('layouts.gpt')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/postagens.css') }}">
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
        <h1>Lista de Postagens</h1>
        <a href="{{ route('postagem.create') }}"><button class="btn btn-primary btn-criar-superior">Criar nova postagem</button></a>
        @if ($postagens->isEmpty())
            <p>Nenhuma postagem encontrada.</p>
        @else
            <div class="postagens-container">
                @foreach($postagens as $postagem)
                    <div class="postagem-card">
                        <h3>{{ $postagem->titulo }}</h3>
                        <p>{!! nl2br(e($postagem->conteudo)) !!}</p>
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
                        @if (Auth::check() && $postagem->user_id === Auth::user()->id)
                        <a href="{{ route('postagem.edit', ['id' => $postagem->id]) }}"><button class="btn btn-primary">Editar</button></a>
                        <form action="{{ route('postagem.destroy', ['id' => $postagem->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
        <a href="{{ route('postagem.create') }}"><button class="btn-criar">Criar nova postagem</button></a>
    </div>
@endsection
