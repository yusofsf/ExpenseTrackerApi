<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\ExpenseDetailController;
use App\Http\Controllers\Api\IncomeController;
use App\Http\Controllers\Api\IncomeDetailController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\StatsController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('/auth')->middleware('throttle:10,1')
    ->controller(AuthController::class)->group(function () {
        Route::post('/login', 'login');
        Route::post('/register', 'register');
        Route::get('/logout', 'logout')->middleware('auth:sanctum');
    });

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/{user}', 'show');
        Route::delete('/users/{user}', 'delete');
        Route::patch('/users/{user}', 'update');
    });

    Route::controller(ExpenseController::class)->group(function () {
        Route::get('/expenses', 'index');
        Route::post('/expenses', 'store');
        Route::get('/expenses/{expense}', 'show');
        Route::delete('/expenses/{expense}', 'delete');
        Route::patch('/expenses/{expense}', 'update');
        Route::post('/expenses/{expense}/expense-details', 'storeDetail');
        Route::patch('/expenses/{expense}/expense-details', 'updateDetail');
    });

    Route::controller(ExpenseDetailController::class)->group(function () {
        Route::get('/expense-details', 'index');
        Route::get('/expense-details/{expense_detail}', 'show');
        Route::delete('/expense-details/{expense_detail}', 'delete');
    });

    Route::controller(IncomeController::class)->group(function () {
        Route::get('/incomes', 'index');
        Route::post('/incomes', 'store');
        Route::get('/incomes/{income}', 'show');
        Route::delete('/incomes/{income}', 'delete');
        Route::patch('/incomes/{income}', 'update');
        Route::post('/incomes/{income}/income-details', 'storeDetail');
        Route::patch('/income/{income}/income-details', 'updateDetail');
    });

    Route::controller(IncomeDetailController::class)->group(function () {
        Route::get('/income-details', 'index');
        Route::get('/income-details/{income_detail}', 'show');
        Route::delete('/income-details/{income_detail}', 'delete');
    });

    Route::controller(StatsController::class)->group(function () {
        Route::get('/stats/last-month', 'lastMonth');
        Route::get('/stats/last-year', 'lastYear');
        Route::get('/stats/last-week', 'lastWeek');
        Route::get('/stats/avg-last-year', 'avgLastYear');
        Route::get('/stats/avg-last-week', 'avgLastWeek');
        Route::get('/stats/avg-last-month', 'avgLastMonth');
        Route::get('/stats/pdf', 'statsToPDF');
    });

    Route::get('/search', SearchController::class);
});