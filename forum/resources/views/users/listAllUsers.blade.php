@extends('layouts.header')

@section('content')
<div class="container mt-5 px-3">
    <div class="user-list" style="font-family: 'Poppins', sans-serif;">
        <br><br><br>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Foto</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('images/default-avatar.png') }}" 
                                class="rounded-circle" 
                                style="width: 50px; height: 50px; object-fit: cover;">
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#banModal"
                                data-user-id="{{ $user->id }}">
                                <i class="fa-solid fa-user-slash"></i> Excluir
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="banModal" tabindex="-1" aria-labelledby="banModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="banModalLabel">Excluir Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    Você tem certeza que deseja excluir este usuário?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa-solid fa-rotate-left"></i> Voltar
                    </button>

                    <form id="deleteUserForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-user-slash"></i> Excluir
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const deleteUserForm = document.getElementById('deleteUserForm');
        const banModal = document.getElementById('banModal');

        banModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const userId = button.getAttribute('data-user-id');

            deleteUserForm.action = `/users/${userId}/delete`;
        });
    });
</script>
@endsection
