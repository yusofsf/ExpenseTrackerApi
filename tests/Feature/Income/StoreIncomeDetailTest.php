<?php

use App\Models\Income;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;

uses(RefreshDatabase::class);

test('user can create income detail with valid data', function () {
    $user = User::factory()->create();

    Income::factory()->create([
        'title' => 'پروژه برنامه نویسی',
        'user_id' => $user->id
    ]);

    // ایجاد توکن با Sanctum
    Sanctum::actingAs($user);

    $response = $this->post('/api/incomes/1/income-details', [
        'amount' => '10000000',
        'note' => 'کامل پرداخت شد',
        'date' => '2025-02-24 18:16:20'
    ]);

    $response->assertStatus(200);
});

test('user can not create expense detail with invalid data', function () {
    $user = User::factory()->create();

    Income::factory()->create([
        'title' => 'پروژه ساختمانی',
        'user_id' => $user->id
    ]);

    Sanctum::actingAs($user);

    $response = $this->withHeaders([
        'Accept' => 'application/json'])
        ->post('/api/incomes/1/income-details', [
            'amount' => 10000,
            'date' => 2025 - 01 - 20
        ]);

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});
