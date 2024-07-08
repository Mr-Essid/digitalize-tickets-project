<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function(Blueprint $table) {
            $table->string('lastname');
            $table->string('phone_number');
            $table->double('wallet_');
            $table->string('profile_photo_path');
            $table->unsignedInteger('amount_of_tickets');
            $table->unsignedInteger('change_password_times');
            $table->string('cip_address')->nullable();        
        });    //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->drop('lastname');
            $table->drop('phone_number');
            $table->drop('wallet_');
            $table->drop('profile_photo_path');
            $table->drop('amount_of_tickets');
            $table->drop('change_password_times');
            $table->drop('cip_address');        
        });        //
    }
};
