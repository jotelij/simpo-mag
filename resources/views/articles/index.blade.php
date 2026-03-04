<x-layouts::guest :title="__('Log in')">
    <div class="max-w-6xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <header class="mb-8">
            <h1 class="text-3xl font-extrabold">{{ __('Articles') }}</h1>
            <p class="mt-2 text-neutral-600 dark:text-neutral-400">{{ __('Latest articles from our authors') }}</p>
        </header>

        @if($articles->isEmpty())
            <div class="text-center py-12 text-neutral-500">{{ __('No articles found.') }}</div>
        @else
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-2">
                @foreach($articles as $article)
                    @include('flux.cards.article-card-guest', ['article' => $article])
                @endforeach
            </div>
        @endif
    </div>
</x-layouts::guest>

