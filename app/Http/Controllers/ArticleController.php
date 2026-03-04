<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display the specified article (public view).
     */
    public function show(Article $article)
    {
        // increment public views counter
        $article->increment('views');
        $article->refresh();

        return view('articles.show', compact('article'));
    }

    /**
     * Display a listing of articles for guests.
     */
    public function index()
    {
        $articles = Article::latest()->get();
        return view('articles.index', compact('articles'));
    }

    /**
     * Remove the specified article.
     */
    public function destroy(Article $article)
    {
        $user = auth()->user();

        // Only allow registered
        if (! $user) {
            abort(403);
        }

        // // Only allow the article owner to delete
        // if (! $user || $user->id !== $article->user_id) {
        //     abort(403);
        // }

  

        $article->delete();

        return back()->with('status', __('Article deleted.'));
    }

}
