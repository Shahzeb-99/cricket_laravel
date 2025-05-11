<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('match_players', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('match_id')->constrained('matches')->onDelete('cascade');
            $table->foreignId('player_id')->constrained('players')->onDelete('cascade');
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade'); // Team the player played for in this match
            $table->enum('role', ['player', 'captain', 'vice_captain'])->default('player');
            $table->timestamps();

            $table->unique(['match_id', 'player_id']); // Avoid duplicate entries
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('match_players');
    }
};
