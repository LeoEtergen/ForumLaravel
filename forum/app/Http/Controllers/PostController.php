<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Postagem;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;

class PostController extends Controller
{
    public function index()
    {
        $postagens = Postagem::with('tags', 'user')->latest()->get();
        return view('postagem.postagens', compact('postagens'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('postagem.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'conteudo' => 'required',
            'tags' => 'required|array',
        ]);

        $postagem = Postagem::create([
            'titulo' => $request->titulo,
            'conteudo' => $request->conteudo,
            'user_id' => Auth::id(),
        ]);

        $postagem->tags()->sync($request->tags);

        return redirect()->route('postagem.index')->with('success', 'Postagem criada com sucesso!');
    }

    public function edit($id)
    {
        $postagem = Postagem::findOrFail($id);
        $tags = Tag::all();
        return view('postagem.edit', compact('postagem', 'tags'));
    }

    public function updatePost(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'conteudo' => 'required',
        ]);

        $postagem = Postagem::findOrFail($id);
        $postagem->titulo = $request->titulo;
        $postagem->conteudo = $request->conteudo;
        $postagem->save();

        return redirect()->route('postagem.postagens.index')->with('success', 'Postagem atualizada com sucesso!');
    }

    public function tags()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    public function showPostagensByTag($tagId)
    {
        $tag = Tag::findOrFail($tagId);
        $postagens = $tag->postagens()->latest()->get();

        return view('postagem.postagem_por_tag', compact('tag', 'postagens'));
    }

    public function postagensByTag(Tag $tag)
    {
        $postagens = $tag->postagens()->latest()->get();
        return view('tags.postagens', compact('postagens', 'tag'));
    }

    public function destroy($id)
    {
        $postagem = Postagem::find($id);

        if (!$postagem) {
            return redirect()->route('postagem.index')->with('error', 'Postagem não encontrada.');
        }

        $postagem->delete();

        return redirect()->route('postagem.index')->with('success', 'Postagem excluída com sucesso.');
    }
}
