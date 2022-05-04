<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $articles = Article::with('comments')->latest()->paginate(12);
        $articles->each(function($article){
            $article->tags = json_decode($article->tags);
            return $article;
        });
        return view('home', compact('articles'));
    }

    public function show($id){
        $article = Article::with('comments')->findOrFail($id);
        $article->tags = json_decode($article->tags);
        return view('show', compact('article'));
    }
}
