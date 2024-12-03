<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function listAllTags() {
        $tags = Tag::all(); // Obtém todas as tags
        return view('tags.listAllTags', compact('tags'));
    }

    public function createTag() {
        return view('tags.createTag');
    }

    public function storeTag(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Tag::create($request->all());

        return redirect()->route('listAllTags')->with('message-success', 'Tag criada com sucesso!');
    }

    public function listTagById($id) {
        $tag = Tag::findOrFail($id);
        return view('tags.editTag', compact('tag'));
    }

    public function updateTag(Request $request, $id) {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $tag = Tag::findOrFail($id);
        $tag->update($request->all());

        return redirect()->route('listAllTags')->with('message-success', 'Tag atualizada com sucesso!');
    }

    public function deleteTag($id) {
        Tag::destroy($id);
        return redirect()->route('listAllTags')->with('message-success', 'Tag excluída com sucesso!');
    }
}
