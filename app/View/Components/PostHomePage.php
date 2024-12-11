<?php

namespace App\View\Components;

use App\Models\Post;
use Illuminate\View\Component;

class PostHomePage extends Component
{
    public $posts;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Retrieve the last 3 posts and assign them to the posts property
        $this->posts = Post::latest()->take(3)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post-home-page', ['posts' => $this->posts]);
    }
}
