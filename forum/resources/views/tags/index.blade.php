@extends('layouts.gpt')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/postagens_por_tag.css') }}">
    Tags
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

        <div class="tags-container">
            @foreach($tags as $tag)
                <div class="tag-card">
                    <h3>{{ $tag->name }}</h3>
                    <a href="{{ route('postagem.tag', ['tag' => $tag->id]) }}">Ver postagens</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
