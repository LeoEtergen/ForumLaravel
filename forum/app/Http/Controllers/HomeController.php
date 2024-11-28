<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Topic;

class HomeController extends Controller
{
    public function HomeForum()
    {
        $categories = Category::all();
        $latestTopics = Topic::latest()->take(5)->get();

        return view('welcome', [ // Certifique-se de que está usando 'welcome'
            'categories' => $categories,
            'latestTopics' => $latestTopics,
        ]);
    }
}

