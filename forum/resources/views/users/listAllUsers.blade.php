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
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->is_suspended ? 'Desativado' : 'Ativo' }}</td>
                        <td>
                            @if(auth()->user()->role == 'admin')
                                <a class="btn btn-warning disabled"><i class="fa-solid fa-head-side-cough-slash"></i>
                                    Suspender</a>
                                <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#banModal"><i
                                        class="fa-solid fa-user-slash"></i> Banir</a>
                            @elseif(auth()->user()->role == 'moderator')
                                <form action="{{ route('user.toggleSuspension', $user->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('POST')

                                    <button type="submit" class="btn btn-warning">
                                        <i class="fa-solid fa-head-side-cough-slash"></i>
                                        {{ $user->is_suspended ? 'Reativar' : 'Suspender' }}
                                    </button>
                                </form>
                            @else
                                <a class="btn btn-warning disabled"><i class="fa-solid fa-head-side-cough-slash"></i>
                                    Suspender</a>
                                <a class="btn btn-danger disabled"><i class="fa-solid fa-user-slash"></i> Banir</a>
                            @endif
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
                    <h5 class="modal-title" id="banModalLabel">Banir Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    Você tem certeza que deseja banir este usuário?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa-solid fa-rotate-left"></i> Voltar
                    </button>

                    <button type="button" class="btn btn-danger">
                        <i class="fa-solid fa-user-slash"></i> Confirmar Banimento
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection