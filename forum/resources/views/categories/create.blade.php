@extends('layouts.gpt')

@section('content')
<h1>Criar Nova Categoria</h1>

<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <label for="title">Título:</label>
    <input type="text" name="title" required>

    <label for="description">Descrição:</label>
    <textarea name="description" required></textarea>

    <button type="submit">Salvar</button>
</form>
@endsection