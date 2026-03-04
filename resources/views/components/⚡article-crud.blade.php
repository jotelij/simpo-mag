<?php

use App\Models\Article;
use Livewire\Component;

new class extends Component
{
    public function posts() {
        return Article::latest()->get();
    }

};
?>

<div>
    {{-- I have not failed. I've just found 10,000 ways that won't work. - Thomas Edison --}}
</div>