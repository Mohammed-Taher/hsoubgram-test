<?php

namespace App\Http\Controllers;

use App\Models\Post;

class LikeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Post $post)
    {
        $post->likes()->toggle(auth()->id());
        return back();
    }
}
