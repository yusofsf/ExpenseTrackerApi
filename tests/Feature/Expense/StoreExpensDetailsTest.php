<?php

use App\Models\Expense;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;

uses(RefreshDatabase::class);

test('user can create expense detail with valid data', function () {
    $user = User::factory()->create();

    Expense::factory()->create([
        'title' => 'buy a book',
        'user_id' => $user->id
    ]);

    // ایجاد توکن با Sanctum
    Sanctum::actingAs($user);

    $response = $this->post('/api/expenses/1/expense-details', [
        'amount' => '100000',
        'note' => 'کامل پرداخت شد',
        'date' => '2025-01-20 22:22:20'
    ]);

    $response->assertStatus(200);
});

test('user can not create expense detail with invalid data', function () {
    $user = User::factory()->create();

    Expense::factory()->create([
        'title' => 'buy a book',
        'user_id' => $user->id
    ]);

    Sanctum::actingAs($user);

    $response = $this->withHeaders([
        'Accept' => 'application/json'])
        ->post('/api/expenses/1/expense-details', [
            'amount' => 10000,
            'date' => 2025 - 01 - 20
        ]);

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});
