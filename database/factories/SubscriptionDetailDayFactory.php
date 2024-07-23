<?php

namespace Database\Factories;

use App\Models\Day;
use App\Models\SubscriptionDetail;
use App\Models\SubscriptionDetailsDay;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SubscriptionDetailDayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = SubscriptionDetailsDay::class; 

     public function definition(): array
    {

       $subscription_details = SubscriptionDetail::inRandomOrder()->limit(1)->get()[0];
       $day = Day::inRandomOrder()->limit(1)->get()[0];

        return [
             'subscription_details_id' => $subscription_details->id, 
             'day_id' => $day->id, 
             'isAvailableRightNow' => true
        ];
    }
}
