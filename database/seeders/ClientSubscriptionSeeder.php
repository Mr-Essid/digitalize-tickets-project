<?php

namespace Database\Seeders;

use App\Models\ClientSubscription;
use Database\Factories\ClientSubscriptionDetailsFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       ClientSubscription::factory()->count(1)->create(); 
    }
}
