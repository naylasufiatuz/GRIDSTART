<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed ke tabel 'users' (digunakan untuk login admin di AdminAuthController)
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'email' => 'admin@gridstart.test',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
            ]
        );

        // 2. Seed ke tabel 'admins' (jika diperlukan/sebagai cadangan)
        DB::table('admins')->updateOrInsert(
            ['username' => 'admin'],
            [
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
