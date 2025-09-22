<?php

namespace App\Providers;

use App\Repository\General\BrokerRepository;
use App\Repository\General\Interface\BrokerRepositoryInterface;
use App\Repository\General\Interface\PropertyFeatureRepositoryInterface;
use App\Repository\General\Interface\PropertyRepositoryInterface;
use App\Repository\General\Interface\UserRepositoryInterface;
use App\Repository\General\PropertyFeatureRepository;
use App\Repository\General\PropertyRepository;
use App\Repository\General\UserRepository;
use App\Repository\Tenant\BrokerCommentRepository;
use App\Repository\Tenant\BrokerPropertyRepository;
use App\Repository\Tenant\BrokerPropertyViewRepository;
use App\Repository\Tenant\BrokerReactionRepository;
use App\Repository\Tenant\Interface\BrokerCommentRepositoryInterface;
use App\Repository\Tenant\Interface\BrokerPropertyRepositoryInterface;
use App\Repository\Tenant\Interface\BrokerPropertyViewRepositoryInterface;
use App\Repository\Tenant\Interface\BrokerReactionRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BrokerRepositoryInterface::class, BrokerRepository::class);
        $this->app->bind(PropertyRepositoryInterface::class, PropertyRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PropertyFeatureRepositoryInterface::class, PropertyFeatureRepository::class);

        $this->app->bind(BrokerCommentRepositoryInterface::class, BrokerCommentRepository::class);
        $this->app->bind(BrokerPropertyRepositoryInterface::class, BrokerPropertyRepository::class);
        $this->app->bind(BrokerReactionRepositoryInterface::class, BrokerReactionRepository::class);
        $this->app->bind(BrokerPropertyViewRepositoryInterface::class, BrokerPropertyViewRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
