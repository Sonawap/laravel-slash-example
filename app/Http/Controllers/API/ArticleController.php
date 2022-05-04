<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Requests\PostCommentRequest;
use App\Models\Article;

class ArticleController extends Controller
{
    public function comment($id){
        $article = Article::findOrFail($id);

        return response()->json([
            'status' => true,
            'article' => $article->with('comments'),
        ],200);
    }

    public function show($id){
        $article = Article::with(['comments.user'])->findOrFail($id);
        $article->tags = json_decode($article->tags);

        return response()->json([
            'status' => true,
            'article' => $article
        ],200);
    }

    public function index(){
        $articles = Article::paginate(20)->with('comments');

        return response()->json([
            'status' => true,
            'articles' => $articles
        ],200);
    }


    public function like(LikeArticuleRequest $request){
        $article = Article::findOrFail($request->article_id);
        $article->like = $article->like + 1;
        $article->save();

        return response()->json([
            'status' => true,
            'message' => 'Like Saved'
        ],200);
    }

    public function view(LikeArticuleRequest $request){
        $article = Article::findOrFail($request->article_id);
        $article->view = $article->view + 1;
        $article->save();

        return response()->json([
            'status' => true,
            'message' => 'view Saved'
        ],200);
    }

    public function postComment(PostCommentRequest $request){
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->article_id = $request->article_id;
        $comment->user_id = auth()->id;
        $comment->save();

        return response()->json([
            'status' => true,
            'message' => 'comment saved',
            'comment' => $comment
        ],200);
    }

    
}
