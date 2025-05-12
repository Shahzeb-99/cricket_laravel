<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('innings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('match_id')->constrained('matches')->onDelete('cascade'); // match_id to matches table
            $table->foreignId('batting_team_id')->constrained('teams')->onDelete('cascade');
            $table->foreignId('bowling_team_id')->constrained('teams')->onDelete('cascade');
            $table->unsignedTinyInteger('inning_number'); // 1, 2, 3, 4...
            $table->boolean('is_completed')->default(false);

            $table->unsignedSmallInteger('total_runs')->default(0);
            $table->unsignedTinyInteger('total_wickets')->default(0);
            $table->unsignedTinyInteger('total_overs')->default(0);

            $table->timestamps();

            $table->unique(['match_id', 'inning_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('innings');
    }
};
