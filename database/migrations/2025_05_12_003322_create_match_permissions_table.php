<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('match_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id')->constrained('matches')->onDelete('cascade');  // Reference to the match
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');    // Reference to the user
            $table->string('role', 50);  // Role of the user, e.g., 'scorer', 'viewer', 'admin'
            $table->boolean('can_edit')->default(false);   // Can the user edit match data?
            $table->boolean('can_delete')->default(false); // Can the user delete match data?
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('match_permissions');
    }
};
