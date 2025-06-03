<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IncomeDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class IncomeDetailController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return Response::json([
            'message' => 'All Incomes Details',
            'result' => IncomeDetail::all()
        ]);
    }

    /**
     * @param IncomeDetail $incomeDetail
     * @return JsonResponse
     */
    public function show(IncomeDetail $incomeDetail): JsonResponse
    {
        return Response::json([
            'message' => 'incomes details',
            'result' => $incomeDetail
        ]);
    }

    /**
     * @param IncomeDetail $incomeDetail
     * @return JsonResponse
     */
    public function delete(IncomeDetail $incomeDetail): JsonResponse
    {
        $incomeDetail->delete();

        return Response::json([
            'message' => 'incomes details deleted',
        ]);
    }
}
