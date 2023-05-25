<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

test('login screen can be rendered', function () {
    $response = $this->get('/login');
    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    $user = User::create([
        'first_name' => 'jhon',
        'last_name' => 'doe',
        'fullname' => 'ibnu',
        'email' => 'jhon@gmail.com',
        'password' => bcrypt('password'),
        'phone' => '0439859083',
        'sex' => 1,
        'address' => 'jl. jalan',
        'birth_date' => '1999-09-09',
        'profile_picture' => 'default.jpg',
        'role' => 1,
        'active' => 1
    ]);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect('/dashboard');
});

test('users can not authenticate with invalid password', function () {
    $user = User::create([
        'first_name' => 'jhon',
        'last_name' => 'doe',
        'fullname' => 'ibnu',
        'email' => 'jhon@gmail.com',
        'password' => bcrypt('password'),
        'phone' => '0439859083',
        'sex' => 1,
        'address' => 'jl. jalan',
        'birth_date' => '1999-09-09',
        'profile_picture' => 'default.jpg',
        'role' => 1,
        'active' => 1
    ]);

    $response = $this->from('/login')->post('/login', [
        'email' => $user->email,
        'password' => 'invalid-password',
    ]);

    $this->assertGuest();
    $response->assertRedirect('/login');
});

test('users can not authenticate with invalid email', function () {
    $response = $this->from('/login')->post('/login', [
        'email' => 'invalid-email',
        'password' => 'password',
    ]);

    $this->assertGuest();
    $response->assertRedirect('/login');
    $response->assertSessionHasErrors('email');
});

test('users can logout', function () {
    $user = User::create([
        'first_name' => 'jhon',
        'last_name' => 'doe',
        'fullname' => 'ibnu',
        'email' => 'jhon@gmail.com',
        'password' => bcrypt('password'),
        'phone' => '0439859083',
        'sex' => 1,
        'address' => 'jl. jalan',
        'birth_date' => '1999-09-09',
        'profile_picture' => 'default.jpg',
        'role' => 1,
        'active' => 1
    ]);

    $response = $this->post(route('logout'));
    $this->assertGuest();
    $response->assertRedirect(route('login'));
});

test('users can not logout when not authenticated', function () {
    $this->assertGuest();
    $response = $this->post(route('logout'));
    $response->assertRedirect(route('login'));
});

test('users can not access the dashboard when not authenticated', function () {
    $response = $this->get('/dashboard');

    $response->assertRedirect('/login');
});

test('users can access the dashboard when authenticated', function () {
    $this->be(User::create([
        'first_name' => 'jhon',
        'last_name' => 'doe',
        'fullname' => 'ibnu',
        'email' => 'jhon@gmail.com',
        'password' => bcrypt('password'),
        'phone' => '0439859083',
        'sex' => 1,
        'address' => 'jl. jalan',
        'birth_date' => '1999-09-09',
        'profile_picture' => 'default.jpg',
        'role' => 1,
        'active' => 1
    ]));

    $response = $this->get('/dashboard');

    $response->assertStatus(200);
});

test('users can not access the register screen when authenticated', function () {
    $this->be(User::create([
        'first_name' => 'jhon',
        'last_name' => 'doe',
        'fullname' => 'ibnu',
        'email' => 'jhon@gmail.com',
        'password' => bcrypt('password'),
        'phone' => '0439859083',
        'sex' => 1,
        'address' => 'jl. jalan',
        'birth_date' => '1999-09-09',
        'profile_picture' => 'default.jpg',
        'role' => 1,
        'active' => 1
    ]));
    $response = $this->get('/register');

    $response->assertRedirect('/dashboard');
});

test('only admin and cashier can access dashboard', function () {
    $this->be(User::create([
        'first_name' => 'jhon',
        'last_name' => 'doe',
        'fullname' => 'ibnu',
        'email' => 'jhon@gmail.com',
        'password' => bcrypt('password'),
        'phone' => '0439859083',
        'sex' => 1,
        'address' => 'jl. jalan',
        'birth_date' => '1999-09-09',
        'profile_picture' => 'default.jpg',
        'role' => 3,
        'active' => 1
    ]));

    if(Auth::user()->role == 1 || Auth::user()->role == 2){
        $response = $this->get('/dashboard');
        $response->assertStatus(200);
    }else{
        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect(route('user.home'));
    }
});


