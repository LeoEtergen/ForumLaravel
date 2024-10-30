@extends('layouts.gpt')

@section('content')
    <h1>Lista de Tags</h1>

    <a href="{{ route('tags.create') }}">Criar Nova Tag</a>

    <ul>
        @foreach ($tags as $tag)
            <li>
                {{ $tag->title }}
                <a href="{{ route('tags.edit', $tag->id) }}">Editar</a>
                <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Deletar</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
