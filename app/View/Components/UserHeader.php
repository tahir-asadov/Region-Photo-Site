<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Request;
use Illuminate\View\Component;

class UserHeader extends Component
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
        $currentClassName = 'active';
        
        $links = [
            'uploads' => [
                'title' => 'Uploads',
                'route' => route('author.uploads'),
                'class' => Request::is('dashboard/uploads') ? $currentClassName: '',
            ],
            'new' => [
                'title' => 'New',
                'route' => route('author.upload'),
                'class' => Request::is('dashboard/upload')  ? $currentClassName: '',
            ],
            'profile' => [
                'title' => 'Profile',
                'route' => route('author.profile'),
                'class' => Request::is('dashboard/profile') ? $currentClassName: '',
            ],
            'site' => [
                'title' => 'Site',
                'route' => route('home'),
                'class' => Request::is('home') ? $currentClassName: '',
            ],
        ];
        return view('components.user.header', compact('links'));
    }
}
