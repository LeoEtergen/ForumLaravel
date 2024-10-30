@extends('layouts.gpt')

@section('content')
    <h1>Criar Nova Tag</h1>

    <form action="{{ route('tags.store') }}" method="POST">
        @csrf
        <label for="title">Título:</label>
        <input type="text" name="title" id="title">
        <button type="submit">Salvar</button>
    </form>
@endsection
