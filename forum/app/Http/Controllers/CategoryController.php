<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function listAllCategories()
    {
        $categories = Category::all();
        return view('categories.listAllCategories', ['categories' => $categories]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
        ]);

        Category::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('listAllCategories')->with('message-success', 'Categoria criada com sucesso!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id); // Usa 'id'
        return view('categories.view_category', ['category' => $category]);
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
        ]);

        $category = Category::findOrFail($id); // Usa 'id'
        $category->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('listAllCategories')->with('message-success', 'Categoria atualizada com sucesso!');
    }

    public function deleteCategory($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete(); // Tenta excluir a categoria
            return redirect()->route('listAllCategories')
                ->with('message-success', 'Categoria excluída com sucesso!');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '23000') { // Violação de integridade referencial
                return redirect()->route('listAllCategories')
                    ->with('message-error', 'Não é possível excluir a categoria, pois está vinculada a tópicos.')
                    ->with('show-modal', true); // Marca que o modal deve ser exibido
            }
            throw $e; // Lança outras exceções
        }
    }

    public function showPostsByCategory($id)
    {
        // Encontra a categoria pelo ID
        $category = Category::findOrFail($id);

        // Busca os posts associados à categoria
        $posts = $category->topics()->with('post')->get(); // Assumindo relação entre topics e posts

        // Retorna a view com os dados
        return view('categories.postsByCategory', compact('category', 'posts'));
    }
}
