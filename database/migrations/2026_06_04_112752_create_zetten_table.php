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
        Schema::create('zetten', function (Blueprint $table) {
            $table->id('zet_id');
            $table->int('ronde_id');
            $table->int('speler_id');
            $table->int('rij');
            $table->int('kolom');
            $table->timestamp('gezet_op');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zetten');
    }
};
