<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

uses(RefreshDatabase::class);

test('user can login with valid credentials', function () {
    // Create a test user with relationships
    User::create([
        'user_name' => 'tester',
        'email' => 'test@example.com',
        'password' => Hash::make('password'),
        'phone_number' => '1234567890'
    ]);

    $response = $this->withHeaders([
        'Accept' => 'application/json'
    ])->post('/api/auth/login', [
        'email' => 'test@example.com',
        'password' => 'password'
    ]);

    $response->assertStatus(200);
});

test('user can not login with invalid credentials', function () {
    $response = $this->withHeaders([
        'Accept' => 'application/json'
    ])->post('/api/auth/login', [
        'email' => 'nonexistent@example.com',
        'password' => 'wrongpassword'
    ]);

    $response->assertStatus(Response::HTTP_NOT_FOUND);
});

test('user can not login with empty request', function () {
    $response = $this->withHeaders([
        'Accept' => 'application/json'
    ])->post('/api/auth/login', []);

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});
