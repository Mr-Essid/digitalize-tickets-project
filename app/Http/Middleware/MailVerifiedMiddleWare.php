<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Client;
use Illuminate\Support\Facades\Log;

class MailVerifiedMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $username = $request->input('username');

        Log::debug($username);
        
        if($username != null) {
            $current_user = Client::where('email', $username)->first();
            Log::channel('single')->debug($current_user);
            if($current_user != null) {
                if(!$current_user->mail_verified)
                    return response(
                        content: [
                            'verifiedMail' => false,
                            'message' => 'email not verfied',
                        ],
                        headers: [
                            'X-MAIL-VERIFIED' => 'Missing'
                        ],
                        status: 310
                    );
            }
        }

        return $next($request);
   }
}
