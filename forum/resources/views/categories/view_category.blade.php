@extends('layouts.header')

@section('content')
<div class="create-category-container">
    <form action="{{ route('categories.update', $category->id) }}" method="POST" class="create-category-form">
        <h2 class="create-category-title">Editar Categoria</h2>
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Título da Categoria:</label>
            <input type="text" id="title" name="title" class="form-input" value="{{ old('title', $category->title) }}" required>
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Descrição:</label>
            <textarea id="description" name="description" class="form-input" rows="3" required>{{ old('description', $category->description) }}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <input type="submit" class="btn btn-edit" value="Salvar Alterações">
    </form>
</div>
@endsection
