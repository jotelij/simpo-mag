<x-layouts::guest :title="__('Log in')">
    <div class="max-w-6xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <header class="mb-6">
            <h1 class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">{{ $article->title }}</h1>
            <div class="mt-2 text-sm text-neutral-500 dark:text-neutral-400">
                <span>{{ $article->user?->name ?? __('Unknown') }}</span>
                <span aria-hidden="true">·</span>
                @if($article->created_at)
                    <time datetime="{{ $article->created_at->toDateString() }}">{{ $article->created_at->format('F j, Y') }}</time>
                @endif
                <span aria-hidden="true">·</span>
                <span>{{ $article->views ?? 0 }} {{ __('views') }}</span>
            </div>
        </header>

        <main class="space-y-6">
            @if($article->excerpt)
                <p class="text-base text-neutral-700 dark:text-neutral-300">{{ $article->excerpt }}</p>
            @endif

            @if($article->thumbnail)
                <figure class="my-6">
                    <img src="{{ asset('storage/'.$article->thumbnail) }}" alt="{{ $article->title }}" class="h-100 rounded-md object-cover">
                </figure>
            @endif
           
            <div class="article-body text-neutral-800 dark:text-neutral-100">
                {!! $article->body ?? '<p class="text-neutral-500">'.__('No content').'</p>' !!}
            </div>
        </main>

        <footer class="mt-8 text-sm text-neutral-500 dark:text-neutral-400">
            <a href="{{ route('articles.guest.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline" wire:navigate>&larr; {{ __('Back to articles') }}</a>
        </footer>
    </div>
</x-layouts::guest>
