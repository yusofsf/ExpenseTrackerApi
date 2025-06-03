<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $validated = $request->validated();

        if (Auth::attempt($validated)) {
            $user = Auth::user();

            $token = $user->createToken($user->user_name . $user->phone_number . Carbon::now())->plainTextToken;

            return Response::json([
                'result' => $user,
                'token' => $token,
                'message' => 'User Successfully Logged In',
            ]);
        }

        return Response::json([
            'message' => 'User Not Found'
        ], 404);
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create($request->validated());

        $token = $user->createToken($user->user_name . $user->phone_number . Carbon::now())->plainTextToken;

        return Response::json([
            'result' => $user,
            'token' => $token,
            'message' => 'User Created'
        ], 201);
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        Auth::user()->tokens()->delete();

        return Response::json([
            'message' => 'User Logged Out',
        ], 202);
    }
}
