<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class Like extends Component
{
    public Post $post;
    public $liked = false;

    public function mount()
    {
        $this->liked = $this->post->liked(auth()->user());
    }

    public function toggle_like()
    {
        $this->post->likes()->toggle(auth()->id());
        $this->liked = !$this->liked;
    }

    public function render()
    {
        return view('livewire.like');
    }
}
