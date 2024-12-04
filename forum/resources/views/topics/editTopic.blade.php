@extends('layouts.header')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/topic/EditTopic.css') }}">
@endpush

@if($topic->user_id !== auth()->id())
    <script>
        window.location.href = "{{ route('topics.listAllTopics') }}";
    </script>
@endif

@section('content')
<div class="container">
    <h1>Editar Tópico</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('topics.update', $topic->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $topic->title) }}"
                required>
        </div>

        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea name="description" id="description" class="form-control" rows="5"
                required>{{ old('description', $topic->description) }}</textarea>
        </div>


        <div class="form-group">
            <label for="category_id">Categoria</label>
            <select name="category_id" id="category_id" class="form-input" required>
                <option value="" disabled selected>Selecione uma categoria</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $topic->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tags">Tags</label>
            <select name="tags[]" id="tags" class="form-control" multiple>
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}" {{ $topic->tags->contains($tag->id) ? 'selected' : '' }}>
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
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="1" {{ old('status', $topic->status) == 1 ? 'selected' : '' }}>Ativo</option>
                <option value="0" {{ old('status', $topic->status) == 0 ? 'selected' : '' }}>Inativo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>
</div>
@endsection