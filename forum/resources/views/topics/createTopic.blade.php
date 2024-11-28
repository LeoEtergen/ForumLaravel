@extends('layouts.header')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/topic/CreateTopic.css') }}">
@endpush

@section('content')
<div class="create-post-container">
    <header class="mb-4 d-flex justify-content-between align-items-center">
        <h1>Criar Tópico</h1>
        <a href="{{ route('topics.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Criar Novo Tópico
        </a>
    </header>

    <form method="POST" action="{{ route('storeTopic') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <h1 class="create-post-title">Criar Tópico</h1>

            <label for="title" class="form-label">Título</label>
            <input type="text" name="title" id="title" class="form-input" value="{{ old('title') }}" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description" class="form-label">Descrição</label>
            <textarea name="description" id="description" class="form-input"
                required>{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="category_id" class="form-label">Categoria</label>
            <select name="category_id" id="category_id" class="form-input" required>
                <option value="" disabled selected>Selecione uma categoria</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="tags" class="form-label">Tags</label>
            <select name="tags[]" id="tags" class="form-input" multiple required>
                <option value="" disabled>Selecione as tags</option>
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}" {{ is_array(old('tags')) && in_array($tag->id, old('tags')) ? 'selected' : '' }}>
                        {{ $tag->title }}
                    </option>
                @endforeach
            </select>
            @error('tags')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <small class="form-text text-muted">
                Segure <code>Ctrl</code> (ou <code>Cmd</code> no Mac) para selecionar várias tags.
            </small>
        </div>

        <div class="form-group">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-input" required>
                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Ativo</option>
                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inativo</option>
            </select>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image" class="form-label">Foto</label>
            <input type="file" name="image" id="image" class="form-input">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="submit-button">Criar Tópico</button>
        </div>
    </form>
</div>
@endsection