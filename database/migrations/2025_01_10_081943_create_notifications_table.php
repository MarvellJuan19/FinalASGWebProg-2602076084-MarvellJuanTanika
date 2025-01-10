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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('type');
            $table->string('title')->nullable();
            $table->string('message');
            $table->json('data')->nullable(); // Data tambahan terkait notifikasi
            $table->unsignedBigInteger('related_id')->nullable(); // ID entitas terkait
            $table->string('related_type')->nullable(); // Tipe entitas terkait
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium'); // Prioritas
            $table->boolean('read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
