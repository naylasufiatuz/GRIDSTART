<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan seeder admin
        $this->call(AdminSeeder::class);

        // Buat user testing biasa (opsional)
        User::factory()->create([
            'username' => 'testuser',
            'email' => 'test@example.com',
        ]);
    }
}
