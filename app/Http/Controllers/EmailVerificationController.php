<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class EmailVerificationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $hash_from_the_client)
    {
      $client_that_active_his_email = Client::where('verify_hash', $hash_from_the_client)->first();

      if($client_that_active_his_email == null || $client_that_active_his_email->hash_ex_time < Date::now()) {
        return response(
            status:400,
            content: [
                'email-verification' => 'expired you should signup again'
            ]  
            );
      }

      $client_that_active_his_email->mail_verified = true;
      $client_that_active_his_email->updated_at = Date::now();
      $client_that_active_his_email->verify_hash = null;
      $client_that_active_his_email->save();

      return view('mail.mail-template-verified', ['client' => $client_that_active_his_email]);
    }
}
