@extends('layouts.gpt')

@section('content')
    <h1>Editar Tag</h1>

    <form action="{{ route('tags.update', $tag->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Título:</label>
        <input type="text" name="title" id="title" value="{{ $tag->title }}">
        <button type="submit">Atualizar</button>
    </form>
@endsection
