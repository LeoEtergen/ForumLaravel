@extends('layouts.gpt')

@section('header')
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('css/homePage.css') }}">
    <div class="container">
        <section class="actions">
            <h2>Ações Rápidas</h2>
            <div class="quick-actions">
                <a href="{{ route('postagem.postagens.index') }}" class="quick-action">
                    <i class="fas fa-file-alt"></i>
                    <span>Ver Todas as Postagens</span>
                </a>
                <a href="{{ route('tag.index') }}" class="quick-action">
                    <i class="fas fa-tags"></i>
                    <span>Ver Todas as Tags</span>
                </a>
                <a href="{{ route('listAllUsers') }}" class="quick-action">
                    <i class="fas fa-users"></i>
                    <span>Listar Usuários</span>
                </a>
            </div>
        </section>

        <section class="popular-tags">
            <h2>Tags Populares</h2>
            <div class="tag-list">
                @foreach($popularTags as $tag)
                    <a href="{{ route('postagem.tag', ['tag' => $tag->id]) }}" class="tag-item">{{ $tag->name }}</a>
                @endforeach
            </div>
        </section>

        <section class="about">
            <h2>Sobre o Fórum</h2>
            <p>Este fórum é um trabalho do primeiro ano da faculdade de Análise e Desenvolvimento de Sistemas da Fatec 
                Sorocaba no sistema AMS. Aqui você pode encontrar suporte, compartilhar experiências, e aprender sobre 
                diversos temas.</p>
        </section>

        <section class="contact">
            <h2>Contato</h2>
            <p>Tem alguma dúvida ou sugestão? Futuramente haverá um e-mail de contato.</p>
        </section>
    </div>
@endsection
