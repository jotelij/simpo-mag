<?php

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Article;


new class extends Component
{
    use WithFileUploads;

    public $title = '';
    public $body = '';
    public $excerpt = '';
    public $thumbnail;

    protected $rules = [
        'title' => 'required|string|max:255',
        'body' => 'required|string',
        'excerpt' => 'nullable|string|max:500',
        'thumbnail' => 'nullable|image|max:2048',
    ];

    public function save()
    {
        $data = $this->validate();

        if ($this->thumbnail) {
            $data['thumbnail'] = $this->thumbnail->store('articles', 'public');
        }

        $article = Article::create([
            'title' => $data['title'],
            'body' => $data['body'],
            'excerpt' => $data['excerpt'] ?? null,
            'thumbnail' => $data['thumbnail'] ?? null,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('articles.list');
    }
};
?>
<div class="flex flex-col gap-6">
    <div class="flex w-full flex-col my-4">
        <flux:heading size="xl">{{ _('Create Article') }}</flux:heading>
        <flux:subheading>{{ _("Fill the form to post an article") }}</flux:subheading>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/trix@2.0.0/dist/trix.css">

    <form wire:submit.prevent="save" class="flex flex-col gap-6">
        <!-- Title -->
        <flux:input wire:model="title" name="title" :label="__('Article Title')" type="text" required placeholder="Title" />

        <!-- Excerpt -->
        <flux:input wire:model="excerpt" name="excerpt" :label="__('Excerpt')" type="text" placeholder="Short summary (optional)" />

        <!-- Body (Rich Text) -->
        <div class="">
            <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">{{ __('Article Body') }}</label>
            <input id="body" type="hidden" wire:model.defer="body">
            <trix-editor input="body" class="mt-2" wire:ignore></trix-editor>
        </div>

        <!-- Thumbnail Upload -->
        <div>
            <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">{{ __('Thumbnail') }}</label>
            <input wire:model="thumbnail" type="file" accept="image/*" class="mt-2" />
            <div wire:loading wire:target="thumbnail" class="text-sm text-neutral-500 mt-2">{{ __('Uploading...') }}</div>

            @if ($thumbnail)
                <div class="mt-3 w-48 h-32 overflow-hidden rounded-md border">
                    <img src="{{ $thumbnail->temporaryUrl() }}" alt="preview" class="w-full h-full object-cover">
                </div>
            @endif
        </div>

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full">
                {{ __('Post') }}
            </flux:button>
        </div>
    </form>

    <script src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    <script>
        // When Trix content changes, dispatch an input event so Livewire picks up the value.
        document.addEventListener('trix-change', function (e) {
            const input = document.getElementById(e.target.getAttribute('input'));
            if (!input) return;

            // dispatch a standard input event so Livewire detects the change
            input.dispatchEvent(new Event('input', { bubbles: true }));
        });
    </script>
</div>