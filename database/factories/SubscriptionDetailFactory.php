<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubscriptionDetail>
 */
class SubscriptionDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


     public $subscriptionDetails = [
        'subscriptions' => [
            [
                'label' =>'1 Month Subscription',
                'label franch' => 'Abonnement 1 Moins',
                'price' => 39.9,
                'zone_name' => 'Charguia',
                'deltadate_months' => 1
            ],
            [
                'label' =>'3 Month Subscription',
                'label franch' => 'Abonnement 3 Moins',
                'price' => 89.75,
                'zone_name' => 'Charguia',
                'deltadate_months' => 3
            ],
            [
                'label' =>'1 Year Subscription',
                'label franch' => 'Abonnement 1 Annee',
                'price' => 399,
                'zone_name' => 'Charguia',
                'deltadate_months' => 12
            ],
            
        ]        
     ];


    public function definition(): array
    {
        return [
            'label' => fake()->price
        ];
    }
}
