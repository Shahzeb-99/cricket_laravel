<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('overs', function (Blueprint $table) {
            $table->id(); // auto-incrementing primary key
            $table->foreignId('innings_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('over_number');
            $table->foreignId('bowler_id')->constrained('players')->onDelete('cascade');
            $table->unsignedInteger('total_runs')->default(0);
            $table->unsignedInteger('total_wickets')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('overs');
    }
};
