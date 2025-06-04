<?php

use App\Models\Expense;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;

uses(RefreshDatabase::class);

test('authenticated user can delete expense', function () {
    $user = User::factory()->create();

    Expense::factory()->create([
        'title' => 'خرید غذا',
        'category' => 'غذا',
        'user_id' => $user->id
    ]);

    Sanctum::actingAs($user);

    $response = $this->withHeaders([
        'Accept' => 'application/json'])
        ->delete('/api/expenses/1');

    $response->assertStatus(200);
});

test('unauthenticated user can not create expense', function () {
    $user = User::factory()->create();

    Expense::factory()->create([
        'title' => 'خرید غذا',
        'category' => 'غذا',
        'user_id' => $user->id
    ]);

    $response = $this->withHeaders([
        'Accept' => 'application/json'])
        ->delete('/api/expenses/1');

    $response->assertStatus(Response::HTTP_UNAUTHORIZED);
});
