<?php

namespace App\Providers;

use App\Repositories\EloquentBedRepository;
use App\Repositories\EloquentBookingRepository;
use App\Repositories\EloquentOrganizationRepository;
use App\Repositories\Interfaces\BookingRepositoryInterface;
use App\Repositories\Interfaces\ResidentRepositoryInterface;
use App\Services\Interfaces\BookingServiceInterface;
use App\Services\Interfaces\ResidentServiceInterface;
use App\Services\OrganizationService;
use Illuminate\Support\ServiceProvider;
use App\Services\UserService;
use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\EloquentUserRepository;
use App\Services\Interfaces\AuthServiceInterface;
use App\Services\AuthService;
use App\Services\Interfaces\RoomServiceInterface;
use App\Repositories\Interfaces\RoomRepositoryInterface;
use App\Repositories\EloquentRoomRepository;
use App\Repositories\Interfaces\BedRepositoryInterface;
use App\Repositories\Interfaces\OrganizationRepositoryInterface;
use App\Repositories\EloquentResidentRepository;
use App\Services\Interfaces\BedServiceInterface;
use App\Services\RoomService;
use App\Services\BedService;
use App\Services\BookingService;
use App\Services\Interfaces\OrganizationServiceInterface;
use App\Services\ResidentService;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(RoomServiceInterface::class, RoomService::class);
        $this->app->bind(RoomRepositoryInterface::class, EloquentRoomRepository::class);
        $this->app->bind(BedServiceInterface::class, BedService::class);
        $this->app->bind(BedRepositoryInterface::class, EloquentBedRepository::class);
        $this->app->bind(ResidentServiceInterface::class, ResidentService::class);
        $this->app->bind(ResidentRepositoryInterface::class, EloquentResidentRepository::class);
        $this->app->bind(OrganizationServiceInterface::class, OrganizationService::class);
        $this->app->bind(OrganizationRepositoryInterface::class, EloquentOrganizationRepository::class);
        $this->app->bind(BookingServiceInterface::class, BookingService::class);
        $this->app->bind(BookingRepositoryInterface::class, EloquentBookingRepository::class);
    }
}
