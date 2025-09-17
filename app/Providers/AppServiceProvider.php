<?php

namespace App\Providers;

use App\Repository\General\BrokerRepository;
use App\Repository\General\Interface\BrokerRepositoryInterface;
use App\Repository\Tenant\BrokerCommentRepository;
use App\Repository\Tenant\BrokerPropertyRepository;
use App\Repository\Tenant\BrokerReactionRepository;
use App\Repository\Tenant\Interface\BrokerCommentRepositoryInterface;
use App\Repository\Tenant\Interface\BrokerPropertyRepositoryInterface;
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

        $this->app->bind(BrokerCommentRepositoryInterface::class, BrokerCommentRepository::class);
        $this->app->bind(BrokerPropertyRepositoryInterface::class, BrokerPropertyRepository::class);
        $this->app->bind(BrokerReactionRepositoryInterface::class, BrokerReactionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
