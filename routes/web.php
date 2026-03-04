<?php

use Illuminate\Support\Facades\Route;

Route::get('/',  [App\Http\Controllers\ArticleController::class, 'index'])->name('home');
Route::get('/articles/{article}', [App\Http\Controllers\ArticleController::class, 'show'])->name('articles.guest.show');
Route::get('/articles', [App\Http\Controllers\ArticleController::class, 'index'])->name('articles.guest.index');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard', [
            'articleCount' => \App\Models\Article::count(),
            'userCount' => \App\Models\User::count(),
            'articles' => \App\Models\Article::with('user')->latest()->take(5)->get(),
        ]);
    })->name('dashboard');
    Route::livewire('dashboard/articles', 'pages::article.list')->name('articles.list');
    Route::livewire('dashboard/articles/create', 'pages::article.create')->name('articles.create');
    Route::livewire('dashboard/articles/{article}', 'pages::article.show')->name('articles.show');
    Route::livewire('dashboard/articles/{article}/edit', 'pages::article.edit')->name('articles.edit');
    // allow deleting an article (only owner)
    Route::delete('dashboard/articles/{article}', [App\Http\Controllers\ArticleController::class, 'destroy'])->name('articles.destroy');
});


require __DIR__.'/settings.php';
