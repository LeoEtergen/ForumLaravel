@extends('layouts.gpt')

@section('header', 'Criar Tag')

@section('content')
    <div class="container">
        <h2>Criar Nova Tag</h2>
        <form action="{{ route('tag.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nome da Tag:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Criar Tag</button>
        </form>
    </div>
@endsection
