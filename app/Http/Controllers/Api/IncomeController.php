<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Income\IncomeStoreRequest;
use App\Http\Requests\Income\IncomeUpdateRequest;
use App\Http\Requests\IncomeDetail\IncomeDetailStoreRequest;
use App\Http\Requests\IncomeDetail\IncomeDetailUpdateRequest;
use App\Models\Income;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class IncomeController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return Response::json([
            'message' => 'All Incomes',
            'result' => Income::all()
        ]);
    }

    /**
     * @param Income $income
     * @return JsonResponse
     */
    public function show(Income $income): JsonResponse
    {
        return Response::json([
            'message' => 'income',
            'result' => $income
        ]);
    }

    /**
     * @param Income $income
     * @return JsonResponse
     */
    public function delete(Income $income): JsonResponse
    {
        $income->delete();

        return Response::json([
            'message' => 'income deleted',
        ]);
    }

    /**
     * @param IncomeStoreRequest $request
     * @return JsonResponse
     */
    public function store(IncomeStoreRequest $request): JsonResponse
    {
        $newIncome = Auth::user()->incomes()->create($request->validated());

        return Response::json([
            'message' => 'income stored',
            'result' => $newIncome
        ]);
    }

    /**
     * @param Income $income
     * @param IncomeDetailStoreRequest $request
     * @return JsonResponse
     */
    public function storeDetail(Income $income, IncomeDetailStoreRequest $request): JsonResponse
    {
        $income->incomeDetail()->create($request->validated());

        return Response::json([
            'message' => 'income detail stored',
            'result' => $income->incomeDetail()->get()
        ]);
    }

    /**
     * @param Income $income
     * @param IncomeDetailUpdateRequest $request
     * @return JsonResponse
     */
    public function updateDetail(Income $income, IncomeDetailUpdateRequest $request): JsonResponse
    {
        $income->incomeDetail()->update($request->validated());

        return Response::json([
            'message' => 'income detail updated',
            'result' => $income->incomeDetail()->get()
        ]);
    }

    /**
     * @param Income $income
     * @param IncomeUpdateRequest $request
     * @return JsonResponse
     */
    public function update(Income $income, IncomeUpdateRequest $request): JsonResponse
    {
        $income->update($request->validated());

        return Response::json([
            'message' => 'income updated',
            'result' => $income
        ]);
    }
}
