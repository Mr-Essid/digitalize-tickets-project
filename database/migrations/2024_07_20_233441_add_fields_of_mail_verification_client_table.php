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
        Schema::table('clients', function(Blueprint $table) {
            $table->text('verify_hash')->nullable();
            $table->date('hash_ex_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function(Blueprint $table) {
            $table->removeColumn('verify_hash');
            $table->removeColumn('hash_ex_time');
        });
    }
};
