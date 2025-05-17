<?php

     use Illuminate\Database\Migrations\Migration;
     use Illuminate\Database\Schema\Blueprint;
     use Illuminate\Support\Facades\Schema;

     return new class extends Migration
     {
         /**
          * Run the migrations.
          *
          * This method is executed when the migration is applied. It modifies the 'players' table
          * by adding a nullable foreign key column 'user_id' that references the 'id' column
          * in the 'users' table. The column is also marked as unique to ensure no duplicate
          * user-player relationships. If a user is deleted, the related player record will
          * also be deleted due to the 'onDelete('cascade')' constraint.
          */
         public function up(): void
         {
             Schema::table('players', function (Blueprint $table) {
                 // Add a nullable, unique foreign key 'user_id' referencing the 'users' table
                 $table->foreignId('user_id')->nullable()->unique()->constrained()->onDelete('cascade');
             });
         }

         /**
          * Reverse the migrations.
          *
          * This method is executed when the migration is rolled back. It should reverse
          * the changes made in the 'up' method. Currently, it does not remove the 'user_id'
          * column or its constraints.
          */
         public function down(): void
         {
             Schema::table('players', function (Blueprint $table) {
                 // Reverse changes made in the 'up' method (currently empty)
             });
         }
     };
