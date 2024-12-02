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
            @foreach ($categories as $category)
            <a href="{{ route('posts.showByCategory', $category->id) }}" class="card">
                <h3>{{ $category->title }}</h3>
                <p>{{ Str::limit($category->description, 50) }}</p>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection