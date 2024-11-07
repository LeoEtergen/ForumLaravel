@extends('layouts.gpt')

@section('content')
<div class="container">
    <h1>Editar Postagem</h1>
    <form action="{{ route('postagem.update', ['id' => $postagem->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" class="form-control" value="{{ $postagem->titulo }}" required>
        </div>
        <div class="form-group">
            <label for="conteudo">Conteúdo:</label>
            <textarea id="conteudo" name="conteudo" class="form-control" required>{{ $postagem->conteudo }}</textarea>
        </div>
        <div class="form-group">
            <label for="tags">Tags:</label>
            <select id="tags" name="tags[]" class="form-control" multiple>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" {{ in_array($tag->id, $postagem->tags->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $tag->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Postagem</button>
    </form>
</div>
@endsection

@section('header')
    <link rel="stylesheet" href="{{ asset('css/createPost.css') }}">
@endsection
