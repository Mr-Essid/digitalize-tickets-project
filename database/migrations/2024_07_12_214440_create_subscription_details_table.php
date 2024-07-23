<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscription_details', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('label_french');
            $table->double('price');
            $table->string('zone_name');
            $table->integer('deltadate_months');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_details');
    }
};
