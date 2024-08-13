<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Logout extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $currentClient = Auth::user();
        $client_ = Client::find($currentClient->id);
        $client_->tokens()->delete();


        return [
            'status' => 'disconnect successfully'
        ];
    }
}
