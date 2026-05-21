<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('quizzes', function (Blueprint $table) {
        $table->id();
        $table->enum('quiz_type', ['obstacle', 'pitstop']); 
        $table->string('obstacle_type')->nullable(); // cth: 'yellow_flag', 'racing_line'
        $table->text('question');
        $table->string('option_a');
        $table->string('option_b');
        $table->string('option_c');
        $table->char('correct_answer', 1);
        $table->integer('points');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
