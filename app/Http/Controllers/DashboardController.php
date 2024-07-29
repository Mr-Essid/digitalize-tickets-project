<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {

        $clients = Client::where('role', '!=', 'ADMIN')->get();

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
                'link' => '#'
            ],
            'subscriptions' => [
                'icon_path' => asset('/storage/images/subscription.png'),
                'link' => '#'
            ],
            'lines' => [
                'icon_path' => asset('/storage/images/bus-stop.png'),
                'link' => '#'
            ],
            'about' => [
                'icon_path' => asset('/storage/images/info.png'),
                'link' => '#'
            ]
        ];


        return view('admin.dashboard', compact(['clients', 'routes', 'keys']));
    }
}
