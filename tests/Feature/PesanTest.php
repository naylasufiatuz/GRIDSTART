<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Pesan;

class PesanTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_can_submit_contact_form()
    {
        $payload = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '08123456789',
            'message' => 'Hello, this is a test message.',
            'agree' => true,
        ];

        $response = $this->postJson('/contact', $payload);

        $response->assertStatus(201)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Pesan Anda berhasil terkirim! Terima kasih!'
                 ]);

        $this->assertDatabaseHas('pesans', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '08123456789',
            'message' => 'Hello, this is a test message.',
            'agree' => true,
        ]);
    }

    public function test_public_submission_validation_errors()
    {
        $payload = [
            'name' => '', // required
            'email' => 'not-an-email', // invalid email
            'message' => '', // required
        ];

        $response = $this->postJson('/contact', $payload);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name', 'email', 'message']);
    }

    public function test_admin_can_crud_pesan()
    {
                // Create an admin user and authenticate
        $admin = User::create([
            'username' => 'admin',
            'email' => 'admin@gridstart.test',
            'password' => bcrypt('password123'),
            'is_admin' => true,
        ]);

        $this->actingAs($admin);

        // 1. Create a Pesan via API
        $payload = [
            'name' => 'Jane Admin',
            'email' => 'jane@admin.com',
            'phone' => '1234567',
            'message' => 'Created by admin.',
            'agree' => false
        ];

        $response = $this->postJson('/api/admin/pesan', $payload);
        $response->assertStatus(201);
        $pesanId = $response->json('data.id');

        $this->assertDatabaseHas('pesans', ['id' => $pesanId, 'name' => 'Jane Admin']);

        // 2. Read Pesans list
        $response = $this->getJson('/api/admin/pesan');
        $response->assertStatus(200)
                 ->assertJsonCount(1, 'data');

        // 3. Update Pesan
        $updatePayload = [
            'name' => 'Jane Admin Edited',
            'message' => 'Updated by admin.'
        ];

        $response = $this->putJson("/api/admin/pesan/{$pesanId}", $updatePayload);
        $response->assertStatus(200);

        $this->assertDatabaseHas('pesans', [
            'id' => $pesanId,
            'name' => 'Jane Admin Edited',
            'message' => 'Updated by admin.'
        ]);

        // 4. Delete Pesan
        $response = $this->deleteJson("/api/admin/pesan/{$pesanId}");
        $response->assertStatus(200);

        $this->assertDatabaseMissing('pesans', ['id' => $pesanId]);
    }
}
