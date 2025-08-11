<?php

namespace App\Services\Interfaces;

use App\Models\User;

interface AuthServiceInterface
{
    public function loginSession(string $email, string $password, bool $remember = false): User;

    public function logoutSession(): void;
}
