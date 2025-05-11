<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 150);
            $table->string('venue', 150);
            $table->string('match_type', 50); // (e.g. 'friendly', 'tournament')
            $table->integer('overs_limit');  // (e.g. 20, 50)
            $table->timestamp('start_time');
            $table->string('status', 20)->default('scheduled');  // ('scheduled', 'live', 'completed')
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
