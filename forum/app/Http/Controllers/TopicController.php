<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// Retirei alguns comentários que não achei necessários. Aqui fizemos as funções para o CRUD dos tópicos.

class TopicController extends Controller
{
    public function listAllTopics()
    {
        $topics = Topic::with('comments')->get();
        return view('topics.listAllTopics', ['topics' => $topics]);
    }

    public function createTopicForm()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('topics.createTopic', compact('categories', 'tags'));
    }

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

        // Cria o tópico
        $topicData = [
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
        ];

        $topic = Topic::create($topicData);

        // Cria o post relacionado ao tópico
        $postData = [
            'user_id' => auth()->id(),
            'image' => $request->hasFile('image') ? $request->file('image')->store('images', 'public') : null,
        ];

        $topic->post()->create($postData);

        // Associa as tags ao tópico
        if ($request->has('tags')) {
            $topic->tags()->sync($request->tags);
        }

        return redirect()->route('listAllTopics')->with('message-success', 'Tópico criado com sucesso!');
    }

    public function editTopicForm($id)
    {
        $topic = Topic::with('tags')->findOrFail($id);

        if ($topic->user_id !== auth()->id()) {
            return redirect()->route('topics.listAllTopics')->with('error', 'Você não tem permissão para editar este tópico.');
        }

        $categories = Category::all();
        $tags = Tag::all();

        return view('topics.editTopic', compact('topic', 'categories', 'tags'));
    }

    public function updateTopic(Request $request, $id)
    {
        $topic = Topic::findOrFail($id);

        if ($topic->user_id !== auth()->id()) {
            return redirect()->route('topics.listAllTopics')->with('error', 'Você não tem permissão para editar este tópico.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $topic->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'category_id' => $request->category_id,
        ]);

        if ($request->hasFile('image')) {
            if ($topic->post && $topic->post->image) {
                Storage::disk('public')->delete($topic->post->image);
            }
            $topic->post->update(['image' => $request->file('image')->store('images', 'public')]);
        }

        $topic->tags()->sync($request->tags ?? []);

        return redirect()->route('listAllTopics')->with('message-success', 'Tópico atualizado com sucesso!');
    }

    public function deleteTopic($id)
    {
        $topic = Topic::findOrFail($id);

        if ($topic->user_id !== auth()->id()) {
            return redirect()->route('topics.listAllTopics')->with('error', 'Você não tem permissão para excluir este tópico.');
        }

        $topic->comments()->delete();

        $topic->delete();

        return redirect()->route('listAllTopics')->with('message-success', 'Tópico excluído com sucesso!');
    }

    public function showTopic($id)
    {
        $topic = Topic::with('category', 'comments.user')->findOrFail($id);
        return view('topics.viewTopic', compact('topic'));
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'topic_tags', 'topic_id', 'tag_id')
            ->withTimestamps()
            ->onDelete('cascade');
    }
}
