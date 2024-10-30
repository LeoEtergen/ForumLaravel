@extends('layouts.gpt')

@section('content')
<div class="container">
    <h1>Criar Nova Postagem</h1>
    <form action="{{ route('postagem.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="conteudo">Conteúdo:</label>
            <textarea id="conteudo" name="conteudo" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="tags">Tags:</label>
            <select id="tags" name="tags[]" class="form-control" multiple>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Criar Postagem</button>
    </form>
</div>
@endsection

@section('header')
    <link rel="stylesheet" href="{{ asset('css/createPost.css') }}">
@endsection
