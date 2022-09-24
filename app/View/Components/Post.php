<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Post extends Component
{
    public $post;
    public $liked_by_users_count;
    public $first_liked_user;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        $this->post = $post;
        $this->liked_by_users_count = $post->likes()->get()->count();
        $this->first_liked_user = $post->likes()->get()->first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post');
    }
}
