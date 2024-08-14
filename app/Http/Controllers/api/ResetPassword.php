<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResetPassword extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $currentClient = Auth::user();
        $request->input([
            'newPassword' => 'required',
            'oldPassword' => 'required'
        ]);

        if (
            !Hash::check($request->input('oldPassword'), $currentClient->password)
        ) {
            return response(status: 403, content: [
                'status' => 'password incorrect, please provide the correct password'
            ]);
        }

        if (Hash::check($request->input('newPassword'), $currentClient->password)) {
            return ['status' => 'password does not change at all'];
        }

        Client::find($currentClient->id)->update(['password' => Hash::make($request->input('newPassword'))]);

        return ['status' => 'password updated successfully'];
    }
}
