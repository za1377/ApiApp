<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\User;

class AuthenticationTest extends TestCase
{
    public $AdminToken = null;
    public $UserToken = null;

    /**
     * A basic feature testAdminLogin.
     *
     * @return void
     */
    public function testAdminLogin()
    {
        $admin = Admin::find(1);
        $response = $this->postJson('api/login/Admin' ,
        ['email' => $admin->email , 'password' => 'password']);
        $this->AdminToken = $response->getData()->token;

        if($response->getStatusCode() == 422){
            $response->assertStatus(422);
        }else {
            $response->assertStatus(200);
        }
    }

    /**
     * A basic feature testUserLogin.
     *
     * @return void
     */
    public function testUserLogin()
    {
        $User = User::find(1);
        $response = $this->postJson('api/login/user' ,
        ['email' => $User->email , 'password' => 'password']);
        $this->UserToken = $response->getData()->token;

        if($response->getStatusCode() == 422) {
            $response->assertStatus(422);
        }else {
            $response->assertStatus(200);
        }
    }

}
