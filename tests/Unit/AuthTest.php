<?php

namespace Tests\Unit;
use Illuminate\Contracts\Console\Kernel;
use Tests\TestCase;

class AuthTest extends TestCase
{

    /**

     * @test

     */
    public function loginTest()
    {
        $loginUrl = '/api/auth/login/';
        $email = 'developerwebmaster3@gmail.com';
        $incorrectpassword = 'incorrect password';
        $password = 'password';

        $response = $this->postJson($loginUrl, [
            'email' => $email,
            'password' => $incorrectpassword
        ]);

        $response
            ->assertStatus(401)
            ->assertJsonStructure([
                'error', 'message'
            ]);

    }
}
