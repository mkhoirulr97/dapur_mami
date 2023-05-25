<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccessAllPageTest extends TestCase
{
    public function menu_admin_can_be_accessed()
    {
        $user = User::create([
            'first_name' => 'jhon',
            'last_name' => 'doe',
            'fullname' => 'ibnu',
            'email' => 'jhon@gmail.com',
            'password' => password_hash('password', PASSWORD_DEFAULT),
            'phone' => '0439859083',
            'sex' => 1,
            'address' => 'jl. jalan',
            'birth_date' => '1999-09-09',
            'profile_picture' => 'default.jpg',
            'role' => 1,
            'active' => 1
        ]);

        $response = $this->actingAs($user)->get(route('admin.menu.index'));

        $response->assertStatus(200);
    }
}
