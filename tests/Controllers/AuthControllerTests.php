<?php
namespace Tests\Controllers;

use Illuminate\Http\Response;
use Tests\TestCase;

class AuthControllerTests extends TestCase {

    public function testAuthRegister(){
        $postData = [
            'name' => 'Flo Gerlach III',
            'email' => 'will.otis@example.com',
            'password' => env('ADMIN_USER_PASSWORD'),
            'password_confirmation' => env('ADMIN_USER_PASSWORD'),
        ];
        $response = $this->call('POST', 'api/auth/register', $postData);

        $this->assertEquals(200, $response->status());
    }

    public function testAuthLogin() {

        $postData = [
            'email' => 'will.otis@example.com',
            'password' => env('ADMIN_USER_PASSWORD'),
        ];
        $response = $this->call('POST', 'api/auth/login', $postData);

        return json_decode($response->getContent());

    }

    public function testCurrencies()
    {

        $loginResult = $this->testAuthLogin();

        $server = ['HTTP_AUTHORIZATION' => 'Bearer ' . $loginResult->access_token];

        $response = $this->call('GET', 'api/currencies', [], [], [], $server);

        var_dump(json_decode($response->getContent()));
    }

    public function testCurrenciesWithCharCode()
    {
        $charCode = 'AUD';
        $loginResult = $this->testAuthLogin();

        $server = ['HTTP_AUTHORIZATION' => 'Bearer ' . $loginResult->access_token];

        $response = $this->call('GET', 'api/currencies/' . $charCode, [], [], [], $server);
        var_dump(json_decode($response->getContent()));
    }

}
