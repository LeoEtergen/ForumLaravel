<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Topic;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Armazena um novo comentário
    public function store(Request $request, $topicId)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $comment = Comment::create([
            'content' => $request->content,
            'topic_id' => $topicId,
            'user_id' => auth()->id(),
        ]);

        return response()->json([
            'id' => $comment->id,
            'content' => $comment->content,
            'created_at' => $comment->created_at->diffForHumans(),
            'user' => [
                'id' => $comment->user->id ?? null,
                'name' => $comment->user->name ?? 'Usuário desconhecido',
            ],
        ]);
    }


    // Atualiza um comentário existente
    public function update(Request $request, $topicId, $id)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $comment = Comment::where('id', $id)->where('topic_id', $topicId)->firstOrFail();
        $comment->update(['content' => $request->content]);

        return response()->json([
            'id' => $comment->id,
            'content' => $comment->content,
            'updated_at' => $comment->updated_at->diffForHumans(),
        ]);
    }

    // Exclui um comentário
    public function destroy($topicId, $id)
    {
        $comment = Comment::where('id', $id)->where('topic_id', $topicId)->firstOrFail();
        $comment->delete();

        return response()->json(['success' => true, 'message' => 'Comentário excluído com sucesso.']);
    }
}
