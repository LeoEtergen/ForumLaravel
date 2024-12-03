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
        return view('categories.createCategory');
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
        $category = Category::findOrFail($id);
        return view('categories.editCategory', ['category' => $category]);
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
        ]);

        $category = Category::findOrFail($id);
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
            $category->delete();
            return redirect()->route('listAllCategories')
                ->with('message-success', 'Categoria excluída com sucesso!');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '23000') {
                return redirect()->route('listAllCategories')
                    ->with('message-error', 'Não é possível excluir a categoria, pois está vinculada a tópicos.')
                    ->with('show-modal', true);
            }
            throw $e;
        }
    }

    public function showPostsByCategory($id)
    {
        $category = Category::with('topics')->findOrFail($id);
        $topics = $category->topics;
    
        return view('categories.topicsByCategory', compact('category', 'topics'));
    }    
}
