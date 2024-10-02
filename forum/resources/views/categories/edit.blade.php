@extends('layouts.gpt')

@section('content')
<h1>Editar Categoria</h1>

<form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="title" class="form-label">Título:</label>
    <input type="text" name="title" value="{{ $category->title }}" class="form-control" required>

    <label for="description" class="form-label">Descrição:</label>
    <textarea name="description" class="form-control" required>{{ $category->description }}</textarea>

    <button type="submit">Atualizar</button>
</form>
@endsection