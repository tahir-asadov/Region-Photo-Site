<?php

namespace App\View\Components;

use App\Models\Post;
use Illuminate\View\Component;

class AuthorsPosts extends Component
{
    public $userid;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($userid)
    {
        $this->userid = $userid;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.authors-posts', [
            'posts' => Post::with(['user', 'images', 'city'])->where(['user_id' => $this->userid, 'published' => '1'])->latest()->take(4)->get()
        ]);
    }
}
