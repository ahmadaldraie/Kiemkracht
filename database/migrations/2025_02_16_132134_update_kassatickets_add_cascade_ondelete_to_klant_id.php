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
        Schema::table('kassatickets', function (Blueprint $table) {
            $table->dropForeign(['klant_id']);

            $table->foreign('klant_id')->references('id')->on('klanten')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kassatickets', function (Blueprint $table) {
            $table->dropForeign(['klant_id']);
            $table->foreign('klant_id')->constrained('klanten');
        });
    }
};
