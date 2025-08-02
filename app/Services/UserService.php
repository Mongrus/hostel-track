<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserService implements UserServiceInterface
{
    public function __construct(
        protected UserRepositoryInterface $userRepo
    ) {
    }

    public function register(array $data): User
    {
        $data['password'] = Hash::make($data['password']);

        return $this->userRepo->create($data);
    }
}
