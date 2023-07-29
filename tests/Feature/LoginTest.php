<?php

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_returns_access_token()
    {
        $password = 'Qweasd123';
        $user = User::factory()->create([
            'password' => Hash::make($password)
        ]);

        $response = $this->postJson('/api/v1/login', [
            'email' => $user->email,
            'password' => $password
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['access_token']);
    }

    public function test_login_returns_error()
    {
        $response = $this->postJson('/api/v1/login', [
            'email' => 'noexistingemail@email.com',
            'password' => 'password'
        ]);

        $response->assertStatus(422);
    }

}
