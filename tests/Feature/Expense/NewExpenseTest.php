<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;

uses(RefreshDatabase::class);

test('user can create expense with valid data', function () {
    $user = User::factory()->create();

    // ایجاد توکن با Sanctum
    Sanctum::actingAs($user);

    $response = $this->post('/api/expenses', [
        'title' => 'buy food',
        'description' => 'it was really good',
        'category' => 'food'
    ]);

    $response->assertStatus(200);
});

test('user can not create expense with invalid data', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $response = $this->withHeaders([
        'Accept' => 'application/json'])
        ->post('/api/expenses', [
            'category' => 'foods'
        ]);

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});
