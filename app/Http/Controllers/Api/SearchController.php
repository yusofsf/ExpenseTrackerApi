<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SearchController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        if ($request->string('type') == 'income') {
            $result = Income::where('title', 'LIKE', '%'.$request->string('type').'%')->get();
        } else {
            $result = Expense::where('title', 'LIKE', '%'.$request->string('type').'%')->get();
        }

        return Response::json([
            'result' => $result ?? 'no result',
            'message' => 'search result'
        ]);
    }
}
