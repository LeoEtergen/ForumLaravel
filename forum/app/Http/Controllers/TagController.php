<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function create()
    {
        return view('tag.create');
    }

    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:tags|max:255',
        ]);

        Tag::create([
            'name' => $request->name,
        ]);

        return redirect()->route('tag.create')->with('success', 'Tag criada com sucesso!');
    }
}
