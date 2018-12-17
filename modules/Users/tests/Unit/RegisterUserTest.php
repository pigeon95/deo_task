<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Users\Controllers\Auth\RegisterController;
use Users\Models\User;
use Illuminate\Support\Facades\Artisan;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        Artisan::call('db:seed');
    }

    /**
     * @covers RegisterController::register
     * @param $data
     * @dataProvider userDataProvider
     */
    public function testRegisterUser($data)
    {
        $url = route('register');
        $response = $this->json('POST', $url, $data);
        $this->assertDatabaseHas('users', ['email' => $data['email'], 'status' => 1]);
    }

    /**
     * @return array
     */
    public function userDataProvider()
    {
        return [[
            'data' => [
                'status' => 1,
                'name' => 'name',
                'email' => 'name.surname@example.com',
                'password' => 'Password1',
                'password_confirmation' => 'Password1'
            ]
        ]];
    }
}
