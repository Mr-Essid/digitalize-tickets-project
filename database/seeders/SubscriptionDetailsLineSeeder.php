<?php

namespace Database\Seeders;

use App\Models\SubscriptionDetailsLine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionDetailsLineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     SubscriptionDetailsLine::factory()->count(3)->create();   
    }
}
