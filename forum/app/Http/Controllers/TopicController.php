<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TopicController extends Controller
{
    /**
     * Lista todos os tópicos com comentários.
     */
    public function listAllTopics()
    {
        $topics = Topic::with('comments')->get();
        return view('topics.listAllTopics', ['topics' => $topics]);
    }

    /**
     * Mostra o formulário de criação de tópico.
     */
    public function createTopicForm()
    {
        $categories = Category::all(); // Carrega categorias
        $tags = Tag::all(); // Carrega tags
        return view('topics.createTopic', compact('categories', 'tags'));
    }


    /**
     * Armazena um novo tópico no banco de dados.
     */
    public function storeTopic(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|boolean',
            'image' => 'nullable|image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $topicData = [
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'category_id' => $request->category_id,
        ];

        // Salvar a imagem, se fornecida
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $topicData['image'] = $imagePath;
        }

        // Criar o tópico
        $topic = Topic::create($topicData);

        // Associar as tags ao tópico
        if ($request->has('tags')) {
            $topic->tags()->sync($request->tags);
        }

        return redirect()->route('topics.listAllTopics')->with('message-success', 'Tópico criado com sucesso!');
    }


    /**
     * Mostra o formulário de edição de um tópico.
     */
    public function editTopicForm($id)
    {
        $topic = Topic::with('tags')->findOrFail($id);
        $categories = Category::all(); // Carrega as categorias
        $tags = Tag::all(); // Carrega as tags disponíveis

        return view('topics.editTopic', compact('topic', 'categories', 'tags'));
    }
    /**
     * Atualiza um tópico existente.
     */
    public function updateTopic(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $topic = Topic::findOrFail($id);

        $topic->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'category_id' => $request->category_id,
        ]);

        // Atualiza as tags associadas ao tópico
        $topic->tags()->sync($request->tags ?? []);

        return redirect()->route('topics.listAllTopics')->with('message-success', 'Tópico atualizado com sucesso!');
    }

    /**
     * Remove um tópico.
     */
    public function deleteTopic($id)
    {
        $topic = Topic::findOrFail($id);

        // Exclui os comentários relacionados
        $topic->comments()->delete();

        // Exclui o tópico
        $topic->delete();

        return redirect()->route('topics.listAllTopics')->with('message-success', 'Tópico excluído com sucesso!');
    }

    /**
     * Exibe um único tópico com categoria e comentários.
     */
    public function showTopic($id)
    {
        $topic = Topic::with('category', 'comments.user')->findOrFail($id);
        return view('topics.showTopic', compact('topic'));
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'topic_tags', 'topic_id', 'tag_id')
            ->withTimestamps()
            ->onDelete('cascade');
    }
}
