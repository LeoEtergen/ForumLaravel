@extends('layouts.gpt')

@section('content')
<h1>Editar Categoria</h1>

<form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="title">Título:</label>
    <input type="text" name="title" value="{{ $category->title }}" required>

    <label for="description">Descrição:</label>
    <textarea name="description" required>{{ $category->description }}</textarea>

    <button type="submit">Atualizar</button>
</form>
@endsection