<?php

namespace Database\Seeders;

use App\Models\Expense;
use App\Models\ExpenseDetail;
use App\Models\Income;
use App\Models\IncomeDetail;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()
            ->create([
                'user_name' => 'hossein12345',
                'email' => 'hossein@gmail.com',
                'email_verified_at' => now(),
                'phone_number' => '09123456781',
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ]);

        Expense::factory(200)
            ->for($user)
            ->create()
            ->each(function ($expense) {
                ExpenseDetail::factory()->create([
                    'expense_id' => $expense->id
                ]);
            });

        Income::factory(200)
            ->for($user)
            ->create()
            ->each(function ($income) {
                IncomeDetail::factory()->create([
                    'income_id' => $income->id
                ]);
            });
    }
}
