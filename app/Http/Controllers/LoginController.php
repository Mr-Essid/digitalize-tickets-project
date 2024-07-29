<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $request->validate([
            'email' => 'required|min:4|max:255|email',
            'password' => 'required|min:8|max:255'
        ]);

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'role' => 'ADMIN'])) {

            $request->session()->regenerate();
            return to_route('admin.dashboard');
        } else {

            return back()->withErrors(
                ['fatal-error' => 'email or password incorrect, please make sure you are on the right place!']
            )->onlyInput('email');
        }
    }
}
