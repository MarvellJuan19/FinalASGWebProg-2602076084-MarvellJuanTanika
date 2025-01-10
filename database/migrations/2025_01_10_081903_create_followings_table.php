<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('followings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('follower_id')->constrained('users')->onDelete('cascade'); // User yang mengikuti
            $table->foreignId('followed_id')->constrained('users')->onDelete('cascade');  // User yang diikuti
            $table->timestamps();
    
            // Make sure a user can only follow another once
            $table->unique(['follower_id', 'followed_id']);
        });
    }    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('followings');
    }
};
