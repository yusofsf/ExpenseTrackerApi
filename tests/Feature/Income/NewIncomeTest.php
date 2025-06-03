<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;

uses(RefreshDatabase::class);

test('user can create income with valid data', function () {
    $user = User::factory()->create();

    // ایجاد توکن با Sanctum
    Sanctum::actingAs($user);

    $response = $this->post('/api/incomes', [
        'title' => 'حقوق خرداد',
        'category' => 'حقوق'
    ]);

    $response->assertStatus(200);
});

test('user can not create income with invalid data', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $response = $this->withHeaders([
        'Accept' => 'application/json'])
        ->post('/api/incomes', [
            'category' => 'غذا'
        ]);

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});
