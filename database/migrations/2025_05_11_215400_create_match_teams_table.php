<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('match_teams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('match_id')->constrained('matches')->onDelete('cascade');
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');
            $table->enum('team_role', ['team_a', 'team_b']);  // Role in the match (team A or team B)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('match_teams');
    }
};
