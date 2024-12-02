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
    <br><br>

    <!-- Seção de Tópicos Recentes -->
    <div class="container">
        <h2>Tópicos Recentes</h2>
        <div class="row">
            @forelse ($recentTopics as $topic)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5>{{ $topic->title }}</h5>
                        <p>{{ Str::limit($topic->description, 100) }}</p>
                        <a href="{{ route('listTopicById', $topic->id) }}" class="btn btn-primary">Ver Tópico</a>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-muted">Nenhum tópico recente disponível.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
