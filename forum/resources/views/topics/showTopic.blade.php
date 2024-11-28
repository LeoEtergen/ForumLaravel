@extends('layouts.header')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/topic/showTopic.css') }}">
@endpush

@section('content')
<div class="container mt-5">
    <header class="mb-4">
        <h1>{{ $topic->title }}</h1>
        <p>Status: {{ $topic->status ? 'Ativo' : 'Inativo' }}</p>
        <p>Categoria: {{ $topic->category->title ?? 'Sem categoria' }}</p>
        <p>Tags:
            @forelse ($topic->tags as $tag)
                <span class="badge bg-secondary">{{ $tag->title }}</span>
            @empty
                <span class="text-muted">Nenhuma tag</span>
            @endforelse
        </p>
    </header>

    <section class="topic-details">
        <p>{{ $topic->description }}</p>

        <h3>Comentários</h3>
        <div id="comments-section">
            @foreach ($topic->comments as $comment)
                <div class="comment mb-3">
                    <p><strong>{{ $comment->user->name ?? 'Usuário desconhecido' }}</strong></p>
                    <p class="preserve-whitespace">{{ $comment->content }}</p>
                    <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Formulário para adicionar um novo comentário --}}
    @if(Auth::check())
        <section class="add-comment-form fixed-form">
            <h4>Adicionar um comentário:</h4>
            <form id="add-comment-form" action="{{ route('comments.store', ['topicId' => $topic->id]) }}" method="POST">
                @csrf
                <textarea name="content" class="form-control" rows="3" placeholder="Escreva seu comentário..."
                    required></textarea>
                <button type="submit" class="btn btn-primary mt-2">Comentar</button>
            </form>
        </section>
    @endif
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("add-comment-form");
        form.addEventListener("submit", async function (event) {
            event.preventDefault();

            const formData = new FormData(form);
            const url = form.getAttribute("action");

            try {
                const response = await fetch(url, {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                });

                if (response.ok) {
                    const newComment = await response.json();

                    // Adiciona o novo comentário ao final da lista
                    const commentsSection = document.getElementById("comments-section");
                    const commentHTML = `
                    <div class="comment mb-3">
                        <p><strong>${newComment.user.name ?? 'Usuário desconhecido'}</strong></p>
                        <pre class="preserve-whitespace">${escapeHtml(newComment.content)}</pre>
                        <p class="text-sm text-gray-500">Agora mesmo</p>
                    </div>
                `;
                    commentsSection.innerHTML += commentHTML;

                    // Limpa o textarea
                    form.reset();
                } else {
                    console.error("Erro ao adicionar o comentário.");
                }
            } catch (error) {
                console.error("Erro de conexão:", error);
            }
        });
    });

    // Função para escapar HTML para evitar injeção de código
    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;',
        };
        return text.replace(/[&<>"']/g, function (m) { return map[m]; });
    }
</script>
@endsection