<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Pesan extends EloquentModel
{
    use HasFactory;

    protected $table = 'pesans';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'agree'
    ];

    protected $casts = [
        'agree' => 'boolean',
    ];
}
