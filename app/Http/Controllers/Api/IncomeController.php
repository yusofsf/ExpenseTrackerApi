<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Income\IncomeStoreRequest;
use App\Http\Requests\Income\IncomeUpdateRequest;
use App\Http\Requests\IncomeDetail\IncomeDetailStoreRequest;
use App\Http\Requests\IncomeDetail\IncomeDetailUpdateRequest;
use App\Models\Income;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Response;

class IncomeController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = Income::query()->with('incomeDetail');

        if ($request->has('amount')) {
            $query->whereHas('incomeDetail', function ($query) use ($request) {
                $query->where('amount', $request->string('amount'));
            });
        }

        if ($request->has('category')) {
            $query->where('category', $request->string('category'));
        }

        if ($request->has('date')) {
            $query->whereHas('incomeDetail', function ($query) use ($request) {
                $query->where('date', $request->string('date'));
            });
        }

        $result = $query->get();

        return Response::json([
            'message' => 'All Incomes',
            'result' => $result
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
