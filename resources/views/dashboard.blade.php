<x-layouts::app :title="__('Dashboard')">
    <div class="flex w-full flex-col my-4">
        <flux:heading size="xl">{{ _('Dashboard') }}</flux:heading>
        
    </div>

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-4">
            <!-- Articles count card -->
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 flex items-center justify-center">
                <div class="text-center">
                    <flux:icon.newspaper class="size-20" /> 
                    <h3 class="text-lg font-medium text-neutral-700 dark:text-neutral-200">Articles</h3>
                    <p class="mt-2 text-4xl font-bold text-neutral-900 dark:text-neutral-50">{{ $articleCount }}</p>
                </div>
            </div>

            <!-- Users count card -->
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 flex items-center justify-center">
                <div class="text-center">
                    <flux:icon.users class="size-20" /> 
                    <h3 class="text-lg font-medium text-neutral-700 dark:text-neutral-200">Users</h3>
                    <p class="mt-2 text-4xl font-bold text-neutral-900 dark:text-neutral-50">{{ $userCount }}</p>
                </div>
            </div>

          <!-- Articles count card -->
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 flex items-center justify-center">
                <div class="text-center">
                    <flux:icon.newspaper class="size-20" /> 
                    <h3 class="text-lg font-medium text-neutral-700 dark:text-neutral-200">Articles</h3>
                    <p class="mt-2 text-4xl font-bold text-neutral-900 dark:text-neutral-50">{{ $articleCount }}</p>
                </div>
            </div>

            <!-- Users count card -->
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 flex items-center justify-center">
                <div class="text-center">
                    <flux:icon.users class="size-20" /> 
                    <h3 class="text-lg font-medium text-neutral-700 dark:text-neutral-200">Users</h3>
                    <p class="mt-2 text-4xl font-bold text-neutral-900 dark:text-neutral-50">{{ $userCount }}</p>
                </div>
            </div>

        </div>

        <!-- list of recent articles -->
        <div class="mt-6 w-full overflow-x-auto">
            <h2 class="text-xl font-semibold mb-4 text-neutral-700 dark:text-neutral-200">Recent Articles</h2>
            <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700">
                <thead class="bg-neutral-50 dark:bg-neutral-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Author</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Created</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-neutral-900 divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse($articles as $article)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('articles.show', $article) }}" class="text-blue-600 hover:underline">
                                    {{ $article->title }}
                                </a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $article->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $article->created_at->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-neutral-500">
                                No articles yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts::app>
