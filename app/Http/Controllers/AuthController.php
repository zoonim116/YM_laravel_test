<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends \Illuminate\Routing\Controller
{
    protected UserService $userService;
    public function __construct(UserService $userService)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'recoverPassword']]);
        $this->userService = $userService;
    }

    public function register(RegisterUserRequest $request): JsonResponse
    {
        $user = $this->userService->createUser($request);
        $token = Auth::login($user);
        return response()->json([
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $token = Auth::attempt($request->all());
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized'
            ], 401);
        }
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function recoverPassword(LoginRequest $request): JsonResponse
    {
        $this->userService->recoverPassword($request);
        $this->login($request);
    }
}
