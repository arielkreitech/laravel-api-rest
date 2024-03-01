<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class AuthenticationTest extends TestCase
{
    // use RefreshDatabase;

    // Registration test
    /** @test */
    public function a_user_can_register()
    {
        $userCount = User::count();

        $response = $this->postJson('/api/auth/signup', [
            'name' => 'Test User',
            'email' => "test$userCount@example.com",
            'password' => '123456A*',
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'message',
                     'access_token',
                     'user_id',
                     'is_admin',
                     'token_type'
                 ]);

        $this->assertCount($userCount + 1, User::all());
    }

    // Login test
    /** @test */
    public function a_user_can_login()
    {
        $userCount = User::count();

        // Create a user to login with
        User::create([
            'name' => 'Test User',
            'email' => "test$userCount@example.com",
            'password' => bcrypt('123456A*'),
        ]);

        $response = $this->postJson('/api/auth/login', [
            'email' => "test$userCount@example.com",
            'password' => '123456A*',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'access_token',
                     'token_type'
                 ]);
    }

    // Logout test
    /** @test */
    public function a_user_can_logout()
    {
        // Create a user to login with
        $user = User::factory()->create();

        // Authenticate the user
        Sanctum::actingAs(
            $user,
            ['*']
        );

        $response = $this->getJson('/api/auth/logout');

        $response->assertStatus(200);
    }
}
