<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Topic;

class HomeController extends Controller
{
    public function HomeForum()
    {
        $categories = Category::all();
        $recentTopics = Topic::latest()->take(3)->get();

        return view('welcome', [
            'categories' => $categories,
            'recentTopics' => $recentTopics,
        ]);
    }
}

