<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(
        protected UserServiceInterface $userService
    ) {
    }
    public function create()
    {
        return view('auth.register');
    }

    public function store(RegisterUserRequest $request)
    {
        $this->userService->register($request->validated());

        return redirect()
            ->route('login')
            ->with('status', 'Регистрация прошла успешно');
    }
}
