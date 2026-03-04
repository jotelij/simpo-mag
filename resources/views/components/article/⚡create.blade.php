<?php

use Livewire\Component;

new class extends Component
{
    public $title = '';
    public $body = '';
 
    public function save()
    {
        // Save logic here...
    }
};
?>

<div>
    <input wire:model="title" type="text">
    <input wire:model="body" type="text">
    <button wire:click="save">Save Post</button>
</div>