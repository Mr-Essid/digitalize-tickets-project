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
        Schema::table('subscription_details_lines', function (Blueprint $table) {
            $table->dropForeign('subscription_details_lines_line_id_foreign');
            $table->foreign('line_id')->references('id')->on('lines')->onDelete('cascade')->onUpdate('cascade');
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
