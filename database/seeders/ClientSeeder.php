<?php

namespace Database\Seeders;

use Database\Factories\ClientFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::factory()->count(20)->sequence(
            ['mailVerified' => true],
            ['mailVerified' => false]
        )->create();
    }

}
