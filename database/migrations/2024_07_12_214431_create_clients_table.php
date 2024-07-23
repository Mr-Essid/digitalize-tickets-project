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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('first_name');
            $table->string('lastname');
            $table->boolean('mailVerified')->default(false);
            $table->enum('role', ['ADMIN', 'CLIENT'])->default('CLIENT');
            $table->string('email');
            $table->text('password');
            $table->double('wallet')->default(0);
            $table->text('image_path');
            $table->string('phone_number');
            $table->string('device_name');
            $table->string('app_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
