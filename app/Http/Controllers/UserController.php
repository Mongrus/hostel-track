<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\UserCollection;
use App\Models\User;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(
        protected UserServiceInterface $userService
    ) {
    }
    public function register(RegisterUserRequest $request): JsonResponse
    {
        $this->userService->register($request->validated());

        $users = User::all();

        return response()->json(new UserCollection($users), 201);
    }
}
