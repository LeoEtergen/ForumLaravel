@extends('layouts.header')

@section('content')
<div class="containerAllUsers">
    <div class="categories-list">
        <div class="table-categories-container">
            <h2>Lista de Categorias</h2>
            <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Criar Nova Categoria</a>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Título da Categoria</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
