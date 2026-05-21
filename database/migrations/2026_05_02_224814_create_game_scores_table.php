<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    if (!Schema::hasTable('game_scores')) {
        Schema::create('game_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('score')->default(0);
            $table->string('best_time')->nullable();
            $table->timestamps();
        });
    }
}

    public function down(): void
    {
        Schema::dropIfExists('game_scores');
    }
};