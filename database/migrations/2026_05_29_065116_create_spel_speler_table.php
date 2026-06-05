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
        Schema::create('spel_speler', function (Blueprint $table) {
            $table->id('spel_id');
            $table->integer('speler_id');
            $table->string('symbool');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
