<?php

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;

new class extends Component
{
    use WithFileUploads;

    public Article $article;
    public $title;
    public $body;
    public $excerpt;
    public $thumbnail; // temporary uploaded file

    protected $rules = [
        'title' => 'required|string|max:255',
        'body' => 'required|string',
        'excerpt' => 'nullable|string|max:500',
        'thumbnail' => 'nullable|image|max:2048',
    ];

    public function mount(Article $article)
    {
        $this->article = $article;
        $this->title = $article->title;
        $this->body = $article->body;
        $this->excerpt = $article->excerpt;
    }

    public function save()
    {
        $data = $this->validate();

        if ($this->thumbnail) {
            $path = $this->thumbnail->store('articles', 'public');
            if ($this->article->thumbnail) {
                Storage::disk('public')->delete($this->article->thumbnail);
            }
            $this->article->thumbnail = $path;
        }

        $this->article->title = $data['title'];
        $this->article->body = $data['body'];
        $this->article->excerpt = $data['excerpt'] ?? null;
        $this->article->save();

        return redirect()->route('articles.list');
    }

    public function removeThumbnail()
    {
        if ($this->article->thumbnail) {
            Storage::disk('public')->delete($this->article->thumbnail);
            $this->article->thumbnail = null;
            $this->article->save();
        }
    }
};
?>

<div class="flex flex-col gap-6">
    <div class="flex w-full flex-col">
        <flux:heading size="xl">{{ _('Edit Article') }}</flux:heading>
        <flux:subheading>{{ __('Update article details') }}</flux:subheading>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/trix@2.0.0/dist/trix.css">

    <form wire:submit.prevent="save" class="flex flex-col gap-6">
        <flux:input wire:model="title" name="title" :label="__('Article Title')" type="text" required placeholder="Title" />

        <flux:input wire:model="excerpt" name="excerpt" :label="__('Excerpt')" type="text" placeholder="Short summary (optional)" />

        <!-- Body (Rich Text) -->
        <div>
            <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300">{{ __('Article Body') }}</label>
            <input id="body" type="hidden" wire:model.defer="body" value="{{ $this->body }}">
            <trix-editor input="body" class="mt-2 h-50" wire:ignore></trix-editor>
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
            @elseif($this->article->thumbnail)
                <div class="mt-3 w-48 h-32 overflow-hidden rounded-md border">
                    <img src="{{ asset('storage/'.$this->article->thumbnail) }}" alt="thumbnail" class="w-full h-full object-cover">
                </div>
                <div class="mt-2">
                    <flux:button variant="filled" wire:click.prevent="removeThumbnail">{{ __('Remove thumbnail') }}</flux:button>
                </div>
            @endif
        </div>

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full">{{ __('Update') }}</flux:button>
        </div>
    </form>

    <script src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    <script>
        document.addEventListener('trix-change', function (e) {
            const input = document.getElementById(e.target.getAttribute('input'));
            if (!input) return;
            input.dispatchEvent(new Event('input', { bubbles: true }));
        });
    </script>
</div>
