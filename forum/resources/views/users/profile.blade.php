@extends('layouts.header')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/user/Profile.css') }}">
@endpush

@section('content')
<div class="container">
    @if ($user != null)
    <form action="{{ route('updateUser', [$user->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <h2 class="text-center">Perfil</h2>

        <div class="text-center">
            @if ($user->photo)
            <img src="{{ asset('storage/' . $user->photo) }}" alt="Foto de perfil" class="profile-photo">
            @else
            <img src="{{ asset('storage/photos/default.jpg') }}" alt="Foto padrão" class="profile-photo">
            @endif
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Alterar Foto de Perfil:</label>
            <input type="file" id="photo" name="photo" class="form-control">
            @error('photo')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}"
                placeholder="{{ $user->name }}" required>
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}"
                placeholder="{{ $user->email }}" required>
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Senha:</label>
            <input type="password" id="password" name="password" class="form-control">
            @error('password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="row">
            <div class="col-6">
                <input type="submit" class="btn btn-primary w-100" value="Editar">
            </div>
            <div class="col-6">
                <a class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#banModal">
                    <i class="fa-solid fa-ban"></i> Excluir perfil
                </a>
            </div>
        </div>
    </form>

    <div class="modal fade" id="banModal" tabindex="-1" aria-labelledby="banModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="banModalLabel">Excluir perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Você tem certeza que deseja excluir seu perfil?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa-solid fa-rotate-left"></i> Voltar
                    </button>
                    <form action="{{ route('deleteUser', [$user->id]) }}" method="POST" class="w-50">
                        @csrf
                        @method('delete')
                        <input type="submit" class="btn btn-danger" value=" Confirmar">
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection