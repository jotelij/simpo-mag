<?php

use App\Models\Article;
use Livewire\Component;
use Livewire\Attributes\Computed;

new class extends Component
{   
    #[Computed]
    public function articles() {
        return Article::latest()->get();
    }

};
?>



<div :title="__('Articles List')">
     <div class="flex w-full flex-col my-4">
        <flux:heading size="xl">{{ _('Articles') }}</flux:heading>
    </div>
    <div class="space-y-4">
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($this->articles as $article)
                @include('flux.cards.article-card', ['article' => $article])
            @endforeach
        </div>
    </div>
</div>
