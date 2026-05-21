<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameScore extends Model
{
    use HasFactory;

    // WAJIB: Izinkan semua kolom diisi
    protected $guarded = [];

    public function user()
    {
        // WAJIB: Sesuaikan dengan struktur databasemu (user_id ke id_user)
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }
}