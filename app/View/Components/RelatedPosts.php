<?php

namespace App\View\Components;

use App\Models\Region;
use Illuminate\View\Component;

class RelatedPosts extends Component
{

    public $region;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($region)
    {
        $this->region = $region;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.related-posts', [
            'posts' => Region::where(['slug' => $this->region])->first()->posts()->where([ 'published' => '1'])->with(['user', 'city', 'images'])->latest()->take(4)->get()
        ]);
    }
}
