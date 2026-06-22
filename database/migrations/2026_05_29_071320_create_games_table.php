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
        Schema::create('games', function (Blueprint $table) {
            $table->id();

            $table->foreignId('player_x_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('player_o_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->enum('status', [
                'waiting',
                'active',
                'finished',
            ])->default('waiting');

            $table->foreignId('winner_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->char('current_turn', 1)
                ->default('X');

            $table->timestamp('started_at')
                ->nullable();

            $table->timestamp('finished_at')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spellen_');
    }
};
