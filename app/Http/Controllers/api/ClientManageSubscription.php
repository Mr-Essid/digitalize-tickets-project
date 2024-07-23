<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Models\ClientSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JsonCustomHelper;

class ClientManageSubscription extends Controller
{
    //
    public function index_subscription(int $subscription_id) {
        
        $current_user = Auth::user();
        $current_user = Client::find($current_user->id);
        $subscription = $current_user->subscriptions()->where('id' , $subscription_id)->first();
        
        if($subscription == null) {
            return response(status: 404, content: [
                'status' => 'same things went wrong',
                'description' => 'subscription details not found'
            ]);
        }

        $subscription_details = $subscription->subscriptionDetails()->first();
        // all content of authenticated user
        $lines = $subscription_details->lines()->get();
        $days = $subscription_details->days()->get();
        $all_subscription_details = [
            'subscriptionDetails' => $subscription_details,
            'lines' => $lines,
            'days' => $days
        ];

        

        $data = [
            'subscription' => $subscription,
            'subsription_details' => $all_subscription_details 
        ];

        return $data;
    }
    

    public function subscriptions() {
        
        $current_user = Auth::user();
        $subscriptions = ClientSubscription::where('client_id', $current_user->id)->get();

        return $subscriptions; 
    }

    public function delete_subscription(int $subscription_id) {
        // there is no monay return to those who's cancel the subscription

        $id_current_user = Auth::user()->id;
        $client_subscription = ClientSubscription::where([['client_id', $id_current_user], ['id', $subscription_id]])->first();

        if($client_subscription == null) {
            if($client_subscription == null) {
                return response(status: 404, content: [
                    'status' => 'same things went wrong',
                    'description' => 'subscription details not found'
                ]);
            }
 
        }
        
        $client_subscription->delete();

        return [
            'status' => 'action performe with success',
            'description' => 'subscription deleted successfully'
        ];
    }


}
