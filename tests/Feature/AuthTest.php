<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testRegisterUser()
    {
        $user = factory(User::class)->make();
        $response = $this->post('/api/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertStatus(200);
        $response->dump();
        $this->assertDatabaseHas('users', [
            'email' => $user->email
        ]);
    }

    public function testUserCanLogin()
    {
        $user = factory(User::class)->create();

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'api_token'
            ]
        ]);
    }

    public function testUserCanObtainProfileWithToken()
    {
        $user = factory(User::class)->state('token')->create();
        $response = $this->withHeader('Authorization', 'Bearer ' . $user->api_token)->get('/api/me');
        $response->assertStatus(200);
    }

}
