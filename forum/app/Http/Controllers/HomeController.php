<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postagem;
use App\Models\Tag;

class HomeController extends Controller
{
    public function index()
    {
        $latestPosts = Postagem::latest()->limit(5)->get();
        $popularTags = Tag::orderBy('posts_count', 'desc')->limit(5)->get(); 
        
        return view('homePage', compact('latestPosts', 'popularTags'));
    }
}
