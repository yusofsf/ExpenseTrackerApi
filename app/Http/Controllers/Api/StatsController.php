<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\StatsServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class StatsController extends Controller
{

    /**
     * @var StatsServiceInterface
     */
    private StatsServiceInterface $statsService;

    /**
     * @param StatsServiceInterface $statsService
     */
    public function __construct(StatsServiceInterface $statsService)
    {
        $this->statsService = $statsService;
    }

    /**
     * @return JsonResponse
     */
    public function lastMonth(): JsonResponse
    {
        [$lastMonthExpenses, $lastMonthIncomes, $lastMonthBalance] = $this->statsService->lastMonth();

        return Response::json([
            'message' => 'stats last month',
            'last month expenses' => $lastMonthExpenses,
            'last month incomes' => $lastMonthIncomes,
            'last month balance' => $lastMonthBalance
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function lastYear(): JsonResponse
    {
        [$lastYearExpenses, $lastYearIncomes, $lastYearBalance] = $this->statsService->lastYear();

        return Response::json([
            'message' => 'stats last year',
            'last year expenses' => $lastYearExpenses,
            'last year incomes' => $lastYearIncomes,
            'last year balance' => $lastYearBalance
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function lastWeek(): JsonResponse
    {
        [$lastWeekExpenses, $lastWeekIncomes, $lastWeekBalance] = $this->statsService->lastWeek();

        return Response::json([
            'message' => 'stats last week',
            'last week expenses' => $lastWeekExpenses,
            'last week incomes' => $lastWeekIncomes,
            'last week balance' => $lastWeekBalance
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function avgLastYear()
    {
        [$averageExpenseLastYear, $averageIncomeLastYear] = $this->statsService->avgLastYear();

        return Response::json([
            'message' => 'avg stats last year',
            'avg expenses last year' => $averageExpenseLastYear,
            'avg incomes last year' => $averageIncomeLastYear,
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function avgLastWeek()
    {
        [$averageExpenseLastWeek, $averageIncomeLastWeek] = $this->statsService->avgLastWeek();

        return Response::json([
            'message' => 'avg stats last week',
            'avg expenses last week' => $averageExpenseLastWeek,
            'avg incomes last week' => $averageIncomeLastWeek,
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function avgLastMonth()
    {
        [$averageExpenseLastMonth, $averageIncomeLastMonth] = $this->statsService->avgLastMonth();

        return Response::json([
            'message' => 'avg stats last month',
            'avg expenses last month' => $averageExpenseLastMonth,
            'avg incomes last month' => $averageIncomeLastMonth,
        ]);
    }

    /**
     * @return mixed
     */
    public function statsToPDF()
    {
        return $this->statsService->statsToPDF();
    }
}
