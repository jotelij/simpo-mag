<?php

use App\Models\Article;
use Livewire\Component;

new class extends Component
{
    public Article $article;

    public function mount(Article $article)
    {
        $this->article = $article;
    }
};
?>

<div :title="__('Article')" class="prose dark:prose-invert max-w-none p-6">
    <header class="mb-6">
        <h1 class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">{{ $this->article->title }}</h1>
        <div class="mt-2 text-sm text-neutral-500 dark:text-neutral-400">
            <span>{{ $this->article->user?->name ?? __('Unknown') }}</span>
            <span aria-hidden="true">·</span>
            @if($this->article->created_at)
                <time datetime="{{ $this->article->created_at->toDateString() }}">{{ $this->article->created_at->format('F j, Y') }}</time>
            @endif
            <span aria-hidden="true">·</span>
            <span>{{ $this->article->views ?? 0 }} {{ __('views') }}</span>
        </div>
    </header>

    <main class="space-y-6">
        @if($this->article->excerpt)
            <p class="text-base text-neutral-700 dark:text-neutral-300">{{ $this->article->excerpt }}</p>
        @endif

        @if($this->article->thumbnail)
            <figure class="my-6">
                <img src="{{ asset('storage/'.$this->article->thumbnail) }}" alt="{{ $this->article->title }}" class="w-full rounded-md object-cover">
            </figure>
        @endif

        <div class="article-body text-neutral-800 dark:text-neutral-100">
            {!! $this->article->body ?? '<p class="text-neutral-500">'.__('No content').'</p>' !!}
        </div>
    </main>

    <footer class="mt-8 text-sm text-neutral-500 dark:text-neutral-400">
        <a href="{{ route('articles.list') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline" wire:navigate>&larr; {{ __('Back to articles') }}</a>
    </footer>
</div>
