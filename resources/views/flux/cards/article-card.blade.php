<div class="p-4 bg-white dark:bg-neutral-900 border border-neutral-100 dark:border-neutral-800 rounded-lg shadow-sm hover:shadow-md transition-shadow">
    <div class="flex items-start gap-4">
        @if(!empty($article->thumbnail))
            <div class="w-24 h-24 flex-shrink-0 overflow-hidden rounded-md bg-neutral-100 dark:bg-neutral-800">
                <a href="{{ route('articles.show', $article) }}" wire:navigate>
                    <img src="{{ asset('storage/'.$article->thumbnail) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                </a>
            </div>
        @endif

        <div class="flex-1 min-w-0">
            <h3 class="text-base font-semibold text-neutral-900 dark:text-neutral-100 leading-tight">
                <a href="{{ route('articles.show', $article) }}" class="hover:underline truncate" wire:navigate>{{ $article->title }}</a>
            </h3>
            <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400 truncate">
                {{ \Illuminate\Support\Str::limit($article->excerpt ?? strip_tags($article->body ?? ''), 150) }}
            </p>
            <div class="mt-3 text-xs text-neutral-500 dark:text-neutral-400 flex items-center gap-2">
                <span>{{ $article->user?->name ?? __('Unknown') }}</span>
                <span aria-hidden="true">·</span>
                @if($article->created_at)
                    <time datetime="{{ $article->created_at->toDateString() }}">{{ $article->created_at->diffForHumans() }}</time>
                @endif
            </div>
        </div>

        <div class="flex-shrink-0 self-center space-y-2">
            <a href="{{ route('articles.show', $article) }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-md bg-neutral-50 dark:bg-neutral-800 text-sm font-medium border border-neutral-200 dark:border-neutral-700" wire:navigate>
                {{ __('Read') }}
            </a>

            <div class="flex gap-2 mt-2">
                <a href="{{ route('articles.edit', $article) }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-md bg-neutral-50 dark:bg-neutral-800 text-sm font-medium border border-neutral-200 dark:border-neutral-700" wire:navigate>
                    {{ __('Edit') }}
                </a>

                <form method="POST" action="{{ route('articles.destroy', $article) }}" onsubmit="return confirm('Are you sure you want to delete this article?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-2 px-3 py-2 rounded-md bg-red-50 dark:bg-red-900 text-sm font-medium border border-red-200 dark:border-red-700 text-red-700 dark:text-red-300">
                        {{ __('Delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
