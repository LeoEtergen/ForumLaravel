@extends('layouts.header')

@section('content')
<div class="container mt-5">
    <h2>Posts na Categoria: {{ $category->title }}</h2>

    @if ($posts->isEmpty())
        <p>Não há posts nesta categoria.</p>
    @else
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ Str::limit($post->description, 100) }}</p>
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Ver Post</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
