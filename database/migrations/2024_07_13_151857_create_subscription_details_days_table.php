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
        Schema::create('subscription_details_days', function (Blueprint $table) {
            $table->unsignedBigInteger('day_id');
            $table->unsignedBigInteger('subscription_details_id');
            $table->boolean('isAvailableRightNow');
            $table->foreign('subscription_details_id')->references('id')->on('subscription_details');
            $table->foreign('day_id')->references('id')->on('days');
            $table->primary(['day_id', 'subscription_details_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_details_days');
    }
};
