@extends('layouts.header')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/tags/ListAllTags.css') }}">
@endpush

@section('content')

<div class="containerAllTags">
    @if(session('message-success'))
        <div class="alert alert-success">
            {{ session('message-success') }}
        </div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('createTag') }}" class="btn btn-primary">
            Criar Nova Tag
        </a>
    </div>

    <div class="tags-list">
        <div class="table-tags-container">
            <h2>Lista de Tags</h2>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Título da Tag</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Deletar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tags as $tag)
                        <tr>
                            <td>{{ $tag->title }}</td>
                            <td>
                                <a href="{{ route('listTagById', ['id' => $tag->id]) }}" class="btn btn-warning">Editar</a>
                            </td>
                            <td>
                                <form action="{{ route('deleteTag', ['id' => $tag->id]) }}" method="POST"
                                    onsubmit="return confirm('Tem certeza que deseja excluir esta tag?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Nenhuma tag encontrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection