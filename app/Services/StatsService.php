<?php

namespace App\Services;

use App\Interfaces\StatsServiceInterface;
use App\Models\ExpenseDetail;
use App\Models\IncomeDetail;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Response;

readonly class StatsService implements StatsServiceInterface
{
    /**
     * @param User $user
     */
    public function __construct(private User $user)
    {
    }

    /**
     * @return Response
     */
    public function statsToPDF(): Response
    {
        $pdf = Pdf::setOption(['defaultFont' => 'Roboto'])->loadView('pdf.stats', [
            'avgLastMonth' => $this->avgLastMonth(),
            'avgLastWeek' => $this->avgLastWeek(),
            'avgLastYear' => $this->avgLastYear(),
            'lastMonth' => $this->lastMonth(),
            'lastWeek' => $this->lastWeek(),
            'lastYear' => $this->lastYear()])
            ->save(storage_path('pdfs/') . 'stats ' . Carbon::now()->format('Y-m-d H-i') . '.pdf');

        return $pdf->download('stats' . Carbon::now()->format('Y-m-d H-i') . '.pdf');
    }

    /**
     * @return array
     */
    public function avgLastMonth(): array
    {
        $averageExpenseLastMonth = ExpenseDetail::whereHas('expense', function ($query) {
            $query->where('user_id', $this->user->id);
        })->where('date', '>=', Carbon::now()->subMonth())->avg('amount');

        $averageIncomeLastMonth = IncomeDetail::whereHas('income', function ($query) {
            $query->where('user_id', $this->user->id);
        })->where('date', '>=', Carbon::now()->subMonth())->avg('amount');

        return [$averageIncomeLastMonth, $averageExpenseLastMonth];
    }

    /**
     * @return array
     */
    public function avgLastWeek(): array
    {
        $averageExpenseLastWeek = ExpenseDetail::whereHas('expense', function ($query) {
            $query->where('user_id', $this->user->id);
        })->where('date', '>=', Carbon::now()->subWeek())->avg('amount');

        $averageIncomeLastWeek = IncomeDetail::whereHas('income', function ($query) {
            $query->where('user_id', $this->user->id);
        })->where('date', '>=', Carbon::now()->subWeek())->avg('amount');

        return [$averageIncomeLastWeek, $averageExpenseLastWeek];
    }

    /**
     * @return array
     */
    public function avgLastYear(): array
    {
        $averageExpenseLastYear = ExpenseDetail::whereHas('expense', function ($query) {
            $query->where('user_id', $this->user->id);
        })->where('date', '>=', Carbon::now()->subYear())->avg('amount');

        $averageIncomeLastYear = IncomeDetail::whereHas('income', function ($query) {
            $query->where('user_id', $this->user->id);
        })->where('date', '>=', Carbon::now()->subYear())->avg('amount');

        return [$averageIncomeLastYear, $averageExpenseLastYear];
    }

    /**
     * @return array
     */
    public function lastMonth(): array
    {
        $lastMonthExpenses = ExpenseDetail::whereHas('expense', function ($query) {
            $query->where('user_id', $this->user->id);
        })->where('date', '>=', Carbon::now()->subMonth())->sum('amount');

        $lastMonthIncomes = IncomeDetail::whereHas('income', function ($query) {
            $query->where('user_id', $this->user->id);
        })->where('date', '>=', Carbon::now()->subMonth())->sum('amount');

        $lastMonthBalance = $lastMonthIncomes - $lastMonthExpenses;

        return [$lastMonthExpenses, $lastMonthIncomes, $lastMonthBalance];
    }

    /**
     * @return array
     */
    public function lastWeek(): array
    {
        $lastWeekExpenses = ExpenseDetail::whereHas('expense', function ($query) {
            $query->where('user_id', $this->user->id);
        })->where('date', '>=', Carbon::now()->subWeek())->sum('amount');

        $lastWeekIncomes = IncomeDetail::whereHas('income', function ($query) {
            $query->where('user_id', $this->user->id);
        })->where('date', '>=', Carbon::now()->subWeek())->sum('amount');

        $lastWeekBalance = $lastWeekIncomes - $lastWeekExpenses;

        return [$lastWeekExpenses, $lastWeekIncomes, $lastWeekBalance];
    }

    /**
     * @return array
     */
    public function lastYear(): array
    {
        $lastYearExpenses = ExpenseDetail::whereHas('expense', function ($query) {
            $query->where('user_id', $this->user->id);
        })->where('date', '>=', Carbon::now()->subYear())->sum('amount');

        $lastYearIncomes = IncomeDetail::whereHas('income', function ($query) {
            $query->where('user_id', $this->user->id);
        })->where('date', '>=', Carbon::now()->subYear())->sum('amount');

        $lastYearBalance = $lastYearIncomes - $lastYearExpenses;

        return [$lastYearExpenses, $lastYearIncomes, $lastYearBalance];
    }
}
