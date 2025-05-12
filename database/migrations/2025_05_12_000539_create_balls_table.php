<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('balls', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key

            $table->foreignId('over_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('ball_number'); // Between 1 and 10 (include no-balls, wides etc.)

            $table->foreignId('striker_id')->constrained('players')->onDelete('cascade');
            $table->foreignId('non_striker_id')->constrained('players')->onDelete('cascade');
            $table->foreignId('bowler_id')->constrained('players')->onDelete('cascade');

            $table->unsignedInteger('runs_scored')->default(0);
            $table->json('extras')->nullable(); // e.g. {"wide":1}, {"no_ball":1,"bye":2}

            $table->boolean('is_wicket')->default(false);
            $table->string('wicket_type', 50)->nullable();
            $table->foreignId('dismissed_player_id')->nullable()->constrained('players')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('balls');
    }
};
