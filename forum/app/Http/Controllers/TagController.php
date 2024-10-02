<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    // Mostrar todas as tags
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    // Formulário para criar uma nova tag
    public function create()
    {
        return view('tags.create');
    }

    // Armazenar a nova tag
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255'
        ]);

        Tag::create($request->all());
        return redirect()->route('tags.index')->with('success', 'Tag criada com sucesso!');
    }

    // Formulário de edição de uma tag
    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    // Atualizar a tag
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'title' => 'required|max:255'
        ]);

        $tag->update($request->all());
        return redirect()->route('tags.index')->with('success', 'Tag atualizada com sucesso!');
    }

    // Deletar a tag
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index')->with('success', 'Tag deletada com sucesso!');
    }
}
