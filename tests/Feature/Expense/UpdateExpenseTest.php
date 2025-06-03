<?php

use App\Models\Expense;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;

uses(RefreshDatabase::class);

test('user can update expense with valid data', function () {
    $user = User::factory()->create();

    Expense::factory()->create([
        'title' => 'buy a book',
        'user_id' => $user->id
    ]);

    // ایجاد توکن با Sanctum
    Sanctum::actingAs($user);

    $response = $this->patch('/api/expenses/1', [
        'title' => 'buy food',
        'description' => 'it was really good',
        'category' => 'food'
    ]);

    $response->assertStatus(200);
});

test('user can not update expense with invalid data', function () {
    $user = User::factory()->create();

    Expense::factory()->create([
        'title' => 'buy a book',
        'user_id' => $user->id
    ]);

    Sanctum::actingAs($user);

    $response = $this->withHeaders([
        'Accept' => 'application/json'])
        ->patch('/api/expenses/1', [
            'category' => 'foods'
        ]);

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
});
