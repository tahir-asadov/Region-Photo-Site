<?php

namespace App\View\Components;

use App\Models\City;
use Illuminate\View\Component;

class Cities extends Component
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
        return view('components.cities', [
            'cities' => City::latest()->limit(5)->get()
        ]);
    }
}
