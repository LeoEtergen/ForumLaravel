@extends('layouts.gpt')

@section('header', 'Postagens por Tag')

@section('content')
    <div class="container">
        <h2>Postagens com a Tag: {{ $tag->name }}</h2>
        @foreach($tag->postagens as $postagem)
            <div class="card">
                <div class="card-header">{{ $postagem->titulo }}</div>
                <div class="card-body">
                    <p>{{ $postagem->conteudo }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
