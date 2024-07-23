<?php

namespace Database\Factories;

use App\Models\SubscriptionDetail;
use App\Models\Client;
use App\Models\ClientSubscription;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClientSubscriptionDetailsFactory extends Factory
{

    
    protected $model = ClientSubscription::class; 
    /**
     * Define the model's default state.p
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subscriptionDetails = SubscriptionDetail::inRandomOrder()->limit(1)->get()[0];        
        $client = Client::inRandomOrder()->limit(1)->get()[0];

        $months_number = $subscriptionDetails->deltadate_months;
        $end_date = Date::now()->addMonths($months_number);
        $current_date = Date::now();
        
        return [
            'from' => $current_date,
            'to' => $end_date,
            'subscription_details_id' => $subscriptionDetails->id,
            'client_id' => $client->id
        ];
    }
}
