<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;

uses(RefreshDatabase::class);

test('user can register with valid credentials', function () {
    $response = $this->post('/api/auth/register', [
        'user_name' => 'hamidnnn',
        'phone_number' => '091234567812',
        'email' => 'tiasasana65@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertStatus(201);
});

test('user can not register with invalid credentials', function () {
    $response = $this->withHeaders([
        'Accept' => 'application/json'])->post('/api/auth/register', [
        'user_name' => 'hamidnnn',
        'phone_number' => '091234567812',
        'email' => 'tiasasana65',
        'password' => 'password',
        'password_confirmation' => 'assword',
        'remember_token' => 'gfsdhsaa'
    ]);

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});

test('user can not register with empty request', function () {

    $response = $this->withHeaders([
        'Accept' => 'application/json'])->post('/api/auth/register', []);

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});
