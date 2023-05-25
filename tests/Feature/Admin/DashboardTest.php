<?php

namespace Tests\Feature\Admin;

use App\Models\User;

test('admin dashboard can be accessed', function () {
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
    $response = $this->actingAs($user)->get(route('admin.dashboard'));

    $response->assertStatus(200);
})->group('auth', 'dashboard');

test('admin dashboard cannot be accessed when not authenticated', function () {
    $response = $this->get(route('admin.dashboard'));

    $response->assertStatus(302);
    $response->assertRedirect(route('login'));
})->group('dashboard');

test('admin dashboard cannot be accessed when authenticated as user', function () {
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
        'role' => 3,
        'active' => 1
    ]);

    $response = $this->actingAs($user)->get(route('admin.dashboard'));

    $response->assertStatus(302);
    $response->assertRedirect(route('user.home'));
})->group('auth', 'dashboard');


