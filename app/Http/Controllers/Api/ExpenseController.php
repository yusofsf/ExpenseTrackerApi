<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Expense\ExpenseStoreRequest;
use App\Http\Requests\Expense\ExpenseUpdateRequest;
use App\Http\Requests\ExpenseDetail\ExpenseDetailStoreRequest;
use App\Http\Requests\ExpenseDetail\ExpenseDetailUpdateRequest;
use App\Models\Expense;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ExpenseController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return Response::json([
            'message' => 'All Expenses',
            'result' => Expense::with('expenseDetail')->get()
        ]);
    }

    /**
     * @param Expense $expense
     * @return JsonResponse
     */
    public function show(Expense $expense): JsonResponse
    {
        return Response::json([
            'message' => 'expense',
            'result' => $expense
        ]);
    }

    /**
     * @param Expense $expense
     * @return JsonResponse
     */
    public function delete(Expense $expense): JsonResponse
    {
        $expense->delete();

        return Response::json([
            'message' => 'expense deleted',
        ]);
    }

    /**
     * @param ExpenseStoreRequest $request
     * @return JsonResponse
     */
    public function store(ExpenseStoreRequest $request): JsonResponse
    {
        $newExpense = Auth::user()->expenses()->create($request->validated());

        return Response::json([
            'message' => 'expense stored',
            'result' => $newExpense
        ]);
    }

    /**
     * @param Expense $expense
     * @param ExpenseDetailStoreRequest $request
     * @return JsonResponse
     */
    public function storeDetail(Expense $expense, ExpenseDetailStoreRequest $request): JsonResponse
    {
        $expense->expenseDetail()->create($request->validated());

        return Response::json([
            'message' => 'expense detail stored',
            'result' => $expense->expenseDetail()->get()
        ]);
    }

    /**
     * @param Expense $expense
     * @param ExpenseDetailUpdateRequest $request
     * @return JsonResponse
     */
    public function updateDetail(Expense $expense, ExpenseDetailUpdateRequest $request): JsonResponse
    {
        $expense->expenseDetail()->update($request->validated());

        return Response::json([
            'message' => 'expense detail updated',
            'result' => $expense->expenseDetail()->get()
        ]);
    }

    /**
     * @param Expense $expense
     * @param ExpenseUpdateRequest $request
     * @return JsonResponse
     */
    public function update(Expense $expense, ExpenseUpdateRequest $request): JsonResponse
    {
        $expense->update($request->validated());

        return Response::json([
            'message' => 'expense updated',
            'result' => $expense
        ]);
    }
}
