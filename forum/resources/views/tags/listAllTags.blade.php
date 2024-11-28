@extends('layouts.header')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/tags/ListAllTags.css') }}">
@endpush

@section('content')

<div class="containerAllTags">
    {{-- Exibe uma mensagem de sucesso, caso exista --}}
    @if(session('message-success'))
        <div class="alert alert-success">
            {{ session('message-success') }}
        </div>
    @endif

    {{-- Botão para criar nova tag --}}
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('createTag') }}" class="btn btn-primary"
            style="background-color: #4CAF50; border: none; border-radius: 5px; font-size: 16px; padding: 10px 20px;">
            Criar Nova Tag
        </a>
    </div>

    {{-- Lista de Tags --}}
    <div class="tags-list">
        <div class="table-tags-container">
            <h2>Lista de Tags</h2>

            {{-- Exibe a tabela com tags --}}
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Título da Tag</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Deletar</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Verifica se há tags --}}
                    @forelse ($tags as $tag)
                        <tr>
                            <td>{{ $tag->title }}</td>
                            <td>
                                <a href="{{ route('listTagById', ['id' => $tag->id]) }}" class="btn btn-edit">Editar</a>
                            </td>
                            <td>
                                {{-- Formulário de exclusão com confirmação --}}
                                <form action="{{ route('deleteTag', ['id' => $tag->id]) }}" method="POST"
                                    onsubmit="return confirm('Tem certeza que deseja excluir esta tag?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        {{-- Caso não haja tags, exibe uma mensagem --}}
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