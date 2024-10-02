@extends('layouts.gpt')

@section('content')
<h1>Criar Nova Categoria</h1>

<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <label for="title" style="margin-top:12px" class="form-label">Título:</label>
    <input type="text" name="title" class="form-control" required>

    <label for="description" style="margin-top:12px" class="form-label">Descrição:</label>
    <textarea name="description" class="form-control" required></textarea>

    <button class="btn btn-info" style="margin-top:12px; padding:5px" type="submit">Salvar</button>
</form>
@endsection