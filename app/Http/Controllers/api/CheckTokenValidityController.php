<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckTokenValidityController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Empty Controller instead we check wit buildin auth middlware for laravel 
        // response

        return [
            'status' => 'token reachable, it\'s a valid token'
        ];
    }
}
