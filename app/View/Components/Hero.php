<?php

namespace App\View\Components;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class Hero extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $background_image = Cache::remember('users', 3600, function () {
            return Post::with('images')->inRandomOrder()->limit(1)->get()->first()->original();
        });
        return view('components.hero', compact('background_image'));
    }
}
