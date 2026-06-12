<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class quiz extends Model
{
    protected $table = 'quizzes';

    protected $fillable = [
        'quiz_type',
        'obstacle_type',
        'question',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_answer',
        'points'
    ];
}
