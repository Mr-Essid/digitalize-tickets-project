<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoadCurrentUser extends Controller
{
    public function __invoke(Request $request)
    {
        $current_user = Auth::user();
        $clientWithSub = Client::find($current_user->id);


        return new ClientResource($clientWithSub);
    }
}
