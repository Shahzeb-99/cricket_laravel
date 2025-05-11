<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email')->unique();
            $table->string('phone', 15)->nullable();
            $table->enum('role', ['batsman', 'bowler', 'all-rounder', 'wicketkeeper']);
            $table->date('date_of_birth');
            $table->string('status', 20)->default('active');  // ['active', 'inactive', 'suspended']
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade'); // Foreign key for team
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
