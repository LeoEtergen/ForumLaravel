@extends('layouts.header')

@section('content')
<div class="container mt-5">
    <h1>Tópicos na Categoria: {{ $category->title }}</h1>
    <p>{{ $category->description }}</p>

    @if($topics->isEmpty())
    <p class="text-muted">Nenhum tópico encontrado nesta categoria.</p>
    @else
    <div class="row">
        @foreach ($topics as $topic)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5>{{ $topic->title }}</h5>
                    <p>{{ Str::limit($topic->description, 100) }}</p>
                    <a href="{{ route('listTopicById', $topic->id) }}" class="btn btn-primary">Ver Tópico</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
