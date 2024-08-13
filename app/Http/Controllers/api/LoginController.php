<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'username' => 'required|min:3|max:255|email',
            'password' => 'required|min:8',
            'deviceName' => 'required',
            'appId' => 'required'
        ]);

        $username = $request->input('username');
        $current_client = Client::where('email', $username)->first();
        if ($current_client == null) {
            return response(status: 401, content: ['status' => 'request not authoticated, username or password incorrect']);
        }

        $password = $request->input('password');


        if (!Hash::check($password, $current_client->password)) {
            return response(status: 401, content: ['status' => 'request not authenticated, username or password incorrect']);
        }

        if ($username != 'essid101010@gmail.com' && $username != 'essid120120@gmail.com') {
            $device_name = $request->input('deviceName');

            if ($device_name != $current_client->device_name) {
                return response(status: 403, content: ['status' => 'device unreachable, cannot open the app from other device']);
            }

            $app_id = $request->input('appId');

            if ($app_id != $current_client->app_id) {
                return response(status: 403, content: ['status' => 'application unreachable, do you try to open the account from other device ?']);
            }
        }
        $current_client->tokens()->delete();
        return [
            'accessToken' =>
            $current_client->createToken($current_client->device_name)->plainTextToken,
            'type' => 'bearer'
        ];
    }
}
