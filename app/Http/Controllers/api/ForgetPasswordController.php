<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Jobs\ClearForgetPasswordRow;
use App\Mail\RestPasswordMail;
use App\Models\Client;
use App\Models\ForgetPasswordTokens;
use App\Models\RestPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function getCode(Request $request)
    {

        $request->validate([
            'email' => 'required|email'
        ]);

        $client = Client::where('email', $request->input('email'))->first();

        if ($client  == null) {
            return response(content: [
                'status' => 'email incorrect'
            ], status: 400);
        }

        RestPassword::where('email', $client->email)->delete();
        $randomValue = rand(0, 9999);
        $stringrep = sprintf('%04d', $randomValue);

        $storedValue = Hash::make($stringrep);

        RestPassword::create([
            'email' => $client->email,
            'codehash' => $storedValue,
            'tries' => 0
        ]);

        Mail::to($client->email)->send(
            new RestPasswordMail($client->firstname, $stringrep)
        );

        // code expired after 15 munites
        ClearForgetPasswordRow::dispatch($client->email)->delay(now()->addMinutes(15));


        return [
            'status' => 'code sent to mail successfully'
        ];
    }


    public function tryCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required'
        ]);

        $email = $request->input('email');

        $forgetPasswordPassport = RestPassword::where('email', $email)->first();

        if ($forgetPasswordPassport == null) {
            return response(status: 401, content: [
                'status' => 'token expired'
            ]);
        }



        if ($forgetPasswordPassport->tries >= 10) {
            $forgetPasswordPassport->delete();

            return response(status: 401, content: [
                'status' => 'token expired'
            ]);
        }

        if (!Hash::check($request->input('code'), $forgetPasswordPassport->codehash)) {

            $forgetPasswordPassport->tries = $forgetPasswordPassport->tries + 1;
            $forgetPasswordPassport->save();

            return response(status: 403, content: [
                'status' => 'code not correct, check your code'
            ]);
        }


        ForgetPasswordTokens::where('email', $email)->delete();
        $token = Str::random(64);

        $hashedToken = Hash::make($token);
        ForgetPasswordTokens::create(['email' => $email, 'token' => $hashedToken]);

        // after 20 munite the token will expired

        ClearForgetPasswordRow::dispatch($email, true)->delay(now()->addMinute(20));


        return [
            'passport' => $token
        ];
    }


    public function changePasswordWithPassport(
        Request $request
    ) {
        $request->validate([
            'email' => 'required|email',
            'passport' => 'required',
            'newPassword' => 'required|min:8'
        ]);



        $row = ForgetPasswordTokens::where('email', $request->email)->first();

        if ($row == null) {
            return response(status: 401, content: ['status' => 'passport expired']);
        }

        if (!Hash::check($request->input('passport'), $row->token)) {
            $newKey = Str::random(1024);
            session([$request->input('email') => $newKey]);
            return response(status: 403, content: ['status' => 'passport incorrect', 'key' => $newKey]);
        }


        $client = Client::where('email', $request->input('email'))->first();

        $row->delete();
        $client->password = Hash::make($request->newPassword);
        $client->save();


        return [
            'status' => 'password updated successfully'
        ];
    }
}
