@extends('layouts.header')

@section('content')
<div class="containerAllUsers">
    @if (session('message-success'))
        <div class="alert alert-success">
            {{ session('message-success') }}
        </div>
    @endif

    <div class="categories-list">
        <div class="table-categories-container">
            <h2>Lista de Categorias</h2>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Título da Categoria</th>
                        <th>Editar</th>
                        <th>Deletar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->title }}</td>
                            <td>
                                <a href="{{ route('editCategory', $category->id) }}" class="btn btn-edit">Editar</a>
                                <form action="{{ route('deleteCategory', $category->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal de Erro -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="errorModalLabel">Exclusão não permitida</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                {{ session('message-error') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Script para exibir o modal se a sessão 'show-modal' estiver ativa -->
@if (session('show-modal'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        });
    </script>
@endif