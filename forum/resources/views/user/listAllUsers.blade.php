@extends('layouts.gpt')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/listAllUsers.css') }}">
@endsection

@section('content')
    <div class="container">
        <h2>Listar todos os usuários</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection


