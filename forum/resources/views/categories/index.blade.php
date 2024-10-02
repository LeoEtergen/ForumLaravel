@extends('layouts.gpt')

@section('content')
<h1>Categorias</h1>
<a class="btn btn-info" href="{{ route('categories.create') }}">Criar Nova Categoria</a>

@if ($message = Session::get('success'))
    <div style="margin-top:15px; margin-bottom:15px">{{ $message }}</div>
@endif

<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Título</th>
            <th scope="col">Descrição</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
            <tr>
                <th scope="row">{{ $category->id }}</th>
                <td>{{ $category->title }}</td>
                <td>{{ $category->description }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('categories.edit', $category->id) }}">Editar</a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection