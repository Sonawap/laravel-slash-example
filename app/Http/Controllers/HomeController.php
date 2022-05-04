<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\PostCommentRequest;
use App\Models\Comment;

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

    public function postComment(PostCommentRequest $request){
        if(!auth()->user()){
            return response()->json([
                'status'=> false,
                'messsage' => 'Login to post comment'
            ],403);
        }

        $comment = new Comment();

        $comment->article_id = $request->article_id;
        $comment->user_id = auth()->user()->id;
        $comment->comment = $request->comment;

        $comment->save();

        $comment->user = auth()->user();

        return response()->json([
            'status' => true,
            'comment' => $comment
        ],200);
    }
}
