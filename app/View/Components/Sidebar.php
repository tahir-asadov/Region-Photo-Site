<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Request;
use Illuminate\View\Component;

class Sidebar extends Component
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
        $currentClassName = 'list-group-item-warning';
        $links = [
            'post' => [
                'title' => 'Posts',
                'route' => route('post.index'),
                'class' => (Request::is('admin/post') || Request::is('admin/post/*') ? $currentClassName: ''),
            ],
            'region' => [
                'title' => 'Regions',
                'route' => route('region.index'),
                'class' => (Request::is('admin/region') || Request::is('admin/region/*') ? $currentClassName: ''),
            ],
            'city' => [
                'title' => 'Cities',
                'route' => route('city.index'),
                'class' => (Request::is('admin/city') || Request::is('admin/city/*') ? $currentClassName: ''),
            ],
            'village' => [
                'title' => 'Villages',
                'route' => route('village.index'),
                'class' => (Request::is('admin/village') || Request::is('admin/village/*') ? $currentClassName: ''),
            ],
            'image' => [
                'title' => 'Images',
                'route' => route('image.index'),
                'class' => (Request::is('admin/image') || Request::is('image/*') ? $currentClassName: ''),
            ],
            'user' => [
                'title' => 'Users',
                'route' => route('user.index'),
                'class' => (Request::is('admin/user') || Request::is('admin/user/*') ? $currentClassName: ''),
            ],
            'setting' => [
                'title' => 'Settings',
                'route' => route('setting.index'),
                'class' => (Request::is('admin/setting') || Request::is('admin/setting/*') ? $currentClassName: ''),
            ]
        ];
        
        return view('components.admin.sidebar', compact('links'));
    }
}
