<?php

namespace App\Services;

use App\Models\User;
use App\Services\Interfaces\AuthServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

final class AuthService implements AuthServiceInterface
{
    public function __construct(private UserRepositoryInterface $users)
    {
    }

    public function loginSession(string $email, string $password, bool $remember = false): User
    {
        $user = $this->users->findByEmail($email);
        if (!$user || !Hash::check($password, $user->password)) {
            throw new AuthenticationException('Invalid credentials.');
        }

        Auth::login($user, $remember);
        session()->regenerate();

        return $user;
    }

    public function logoutSession(): void
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
}
