<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('live_match_state', function (Blueprint $table) {
            $table->foreignId('match_id')->primary()->constrained()->onDelete('cascade');
            $table->foreignId('current_innings')->nullable()->constrained('innings')->nullOnDelete();
            $table->foreignId('striker_id')->nullable()->constrained('players')->nullOnDelete();
            $table->foreignId('non_striker_id')->nullable()->constrained('players')->nullOnDelete();
            $table->foreignId('bowler_id')->nullable()->constrained('players')->nullOnDelete();

            $table->unsignedInteger('current_over')->default(0);
            $table->unsignedInteger('current_ball')->default(0);
            $table->unsignedInteger('total_runs')->default(0);
            $table->unsignedInteger('total_wickets')->default(0);
            $table->decimal('overs_completed', 5, 1)->default(0.0);
            $table->timestamp('last_updated')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('live_match_state');
    }
};
