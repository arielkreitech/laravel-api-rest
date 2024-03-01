<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class UserTest extends TestCase
{
    // use RefreshDatabase;

    // Get user by email test
    /** @test */
    public function a_user_can_get_user_by_email()
    {
        // Create a user to login with
        $user = User::factory()->create();

        // Authenticate the user
        Sanctum::actingAs(
            $user,
            ['*']
        );

        $response = $this->getJson('/api/user_by_email?email=' . $user->email);

        $response->assertStatus(200)
                 ->assertJson([
                     'user' => [
                         'email' => $user->email
                     ]
                 ]);
    }

    // Get all users test
    /** @test */
    public function a_user_can_get_all_users()
    {
        // Create a user to login with
        $user = User::factory()->create();

        // Authenticate the user
        Sanctum::actingAs(
            $user,
            ['*']
        );

        $response = $this->getJson('/api/users');

        $response->assertStatus(200);
    }

    // Show user test
    /** @test */
    public function a_user_can_show_a_user()
    {
        // Create a user to login with
        $user = User::factory()->create();

        // Authenticate the user
        Sanctum::actingAs(
            $user,
            ['*']
        );

        $response = $this->getJson('/api/users/' . $user->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'user' => [
                         'email' => $user->email
                     ]
                 ]);
    }

    // Create user test
    /** @test */
    public function a_user_can_create_a_user()
    {
        // Create a user to login with
        $user = User::factory()->create();

        // Authenticate the user
        Sanctum::actingAs(
            $user,
            ['*']
        );

        $userCount = User::count();

        $response = $this->postJson('/api/users', [
            'name' => 'New User',
            'email' => "test$userCount@example.com",
            'password' => 'password',
            'id_card' => '12345678901',
            'date_of_birth' => '2000-01-01',
            'city_code' => 1,
            'phone' => 1234567890,
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('users', [
            'name' => 'New User',
            'email' => "test$userCount@example.com",
        ]);
    }

    // Update user test
    /** @test */
    public function a_user_can_update_a_user()
    {
        // Create a user to login with
        $user = User::factory()->create();

        // Authenticate the user
        Sanctum::actingAs(
            $user,
            ['*']
        );

        $response = $this->putJson('/api/users/' . $user->id, [
            'name' => 'Updated Name',
            'password' => 'updatedpassword',
            'id_card' => '12345678901',
            'date_of_birth' => '2000-01-01',
            'city_code' => 1,
            'phone' => 1234567890,
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
        ]);
    }

    // Delete user test
    /** @test */
    public function a_user_can_delete_a_user()
    {
        // Create a user to login with
        $user = User::factory()->create();

        // Authenticate the user
        Sanctum::actingAs(
            $user,
            ['*']
        );

        $response = $this->deleteJson('/api/users/' . $user->id);

        if ($response->status() == 400) {
            dd($response->json());
        }

        $response->assertStatus(200);

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }

}
