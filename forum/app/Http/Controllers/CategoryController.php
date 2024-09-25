<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Lista todas as categorias
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // Mostra o formulário de criação de nova categoria
    public function create()
    {
        return view('categories.create');
    }

    // Armazena uma nova categoria
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        Category::create($request->all());
        return redirect()->route('categories.index')
            ->with('success', 'Categoria criada com sucesso!');
    }

    // Mostra o formulário de edição de uma categoria específica
    public function edit($id)
    {
        $category = Category::find($id);
        return view('categories.edit', compact('category'));
    }

    // Atualiza uma categoria existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $category = Category::find($id);
        $category->update($request->all());
        return redirect()->route('categories.index')
            ->with('success', 'Categoria atualizada com sucesso!');
    }

    // Remove uma categoria
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('categories.index')
            ->with('success', 'Categoria removida com sucesso!');
    }
}
