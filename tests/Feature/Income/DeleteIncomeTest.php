<?php

use App\Models\Income;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Symfony\Component\HttpFoundation\Response;

uses(RefreshDatabase::class);

test('authenticated user can delete income', function () {
    $user = User::factory()->create();

    Income::factory()->create([
        'title' => 'پاس شدن چک',
        'category' => 'چک',
        'user_id' => $user->id
    ]);

    Sanctum::actingAs($user);

    $response = $this->withHeaders([
        'Accept' => 'application/json'])
        ->delete('/api/incomes/1');

    $response->assertStatus(200);
});

test('unauthenticated user can not create income', function () {
    $user = User::factory()->create();

    Income::factory()->create([
        'title' => 'پاس شدن چک',
        'category' => 'چک',
        'user_id' => $user->id
    ]);

    $response = $this->withHeaders([
        'Accept' => 'application/json'])
        ->delete('/api/incomes/1');

    $response->assertStatus(Response::HTTP_UNAUTHORIZED);
});
