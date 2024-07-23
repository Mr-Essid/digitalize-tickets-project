<?php

namespace Database\Factories;

use App\Models\Line;
use App\Models\SubscriptionDetail;
use App\Models\SubscriptionDetailsLine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SubscriptionDetailLineFactory extends Factory
{
    

    protected $model = SubscriptionDetailsLine::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subscription_details = SubscriptionDetail::inRandomOrder()->limit(1)->get()->first();
        $line = Line::inRandomOrder()->limit(1)->get()->first();


        return [
            'subscription_details_id' => $subscription_details->id,
            'line_id' => $line->id
        ];

    }
}
