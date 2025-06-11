<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Expense\ExpenseStoreRequest;
use App\Http\Requests\Expense\ExpenseUpdateRequest;
use App\Http\Requests\ExpenseDetail\ExpenseDetailStoreRequest;
use App\Http\Requests\ExpenseDetail\ExpenseDetailUpdateRequest;
use App\Models\Expense;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ExpenseController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = Expense::query()->with('expenseDetail');

        if ($request->string('amount')) {
            $query->whereHas('expenseDetail', function ($query) use ($request) {
                $query->where('amount', $request->string('amount'));
            });
        }

        if ($request->string('category')) {
            $query->where('category', $request->string('category'));
        }

        if ($request->string('date')) {
            $query->whereHas('expenseDetail', function ($query) use ($request) {
                $query->where('date', $request->string('date'));
            });
        }

        $result = $query->get();

        return Response::json([
            'message' => 'All Expenses',
            'result' => $result
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
