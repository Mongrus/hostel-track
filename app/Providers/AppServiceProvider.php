<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\EloquentUserRepository;
use App\Services\UserService;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
    }
}
