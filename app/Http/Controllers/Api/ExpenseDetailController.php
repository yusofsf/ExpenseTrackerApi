<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ExpenseDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class ExpenseDetailController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return Response::json([
            'message' => 'All Expense Details',
            'result' => ExpenseDetail::all()
        ]);
    }

    /**
     * @param ExpenseDetail $expenseDetail
     * @return JsonResponse
     */
    public function show(ExpenseDetail $expenseDetail): JsonResponse
    {
        return Response::json([
            'message' => 'expense details',
            'result' => $expenseDetail
        ]);
    }

    /**
     * @param ExpenseDetail $expenseDetail
     * @return JsonResponse
     */
    public function delete(ExpenseDetail $expenseDetail): JsonResponse
    {
        $expenseDetail->delete();

        return Response::json([
            'message' => 'expense details deleted',
        ]);
    }
}
