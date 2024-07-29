<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideBar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $keys = [
            'id',
            'firstname',
            'lastname',
            'email',
            'wallet',
            'phone number'

        ];
        $routes = [
            'home' => [
                'icon_path' => asset('/storage/images/home.png'),
                'link' => route('admin.dashboard')
            ],
            'subscriptions' => [
                'icon_path' => asset('/storage/images/subscription.png'),
                'link' => route('subscription.index')
            ],
            'lines' => [
                'icon_path' => asset('/storage/images/bus-stop.png'),
                'link' => route('line.index')
            ],
            'about' => [
                'icon_path' => asset('/storage/images/info.png'),
                'link' => '#'
            ]
        ];

        return view('components.side-bar', compact(['keys', 'routes']));
    }
}
