<?php

namespace App\Http\Controllers\api;

use App\Events\SendMailAboutSuccessSubscription;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClientSubscriptionDetailsResource;
use App\Mail\SubscriptionSuccessfully;
use App\Models\Client;
use App\Models\ClientSubscription;
use App\Models\SubscriptionDetail;
use App\TransactionCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use JsonCustomHelper;

class ClientSubscribeController extends Controller
{
    /**
     * Handle the incoming request.
     */

     public function __invoke(int $id_sub)
    {
        $current_user = Auth::user();
        $current_user = Client::find($current_user->id);
        $current_subscription_details = SubscriptionDetail::find($id_sub);
        
        $price_of_subscription = $current_subscription_details->price;
       

        if($current_user->wallet < $price_of_subscription) {
            return response(
                content:[
                    'transaction_code' => TransactionCode::FAILED,
                    'status' => 'No Enought Monay You Have, Charge Your Wallet to Select This Option',
                    'info' => 'you can charge you wallet by go the SNT center and charge it'
                ]
                );
        }

        $current_date = Date::now();
        $end_date = Date::now()->addMonths(value:$current_subscription_details->deltadate_months);        
        $subscription_details_client = new ClientSubscription();
        $subscription_details_client->from = $current_date;
        $subscription_details_client->to = $end_date;
        $subscription_details_client->subscription_details_id = $current_subscription_details->id;
        $subscription_details_client->client_id = $current_user->id;

        // decrase the price from the wallet
        
        $current_user->wallet = $current_user->wallet - $price_of_subscription;
        
        $subscription_details_client->save();
        $current_user->save();
        
        Log::channel('single')->debug('subscription dispatched');
        

        $data_returned = [
            'from' => $current_date,
            'to' => $end_date,
            'price' => $price_of_subscription,
            'currentWallet' => $current_user->wallet
        ];


        $mail_data = [];
        foreach ($data_returned as $key => $value) {
            $mail_data[JsonCustomHelper::programmer_readable_to_human_readable($key)] = $value;
        }        

        Mail::to($current_user->email)->send(
            new SubscriptionSuccessfully($mail_data, $current_user)
        );

        return $data_returned;
    }
}
