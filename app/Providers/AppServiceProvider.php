<?php

namespace App\Providers;

use App\Repositories\Contracts\ImageRepositoryContract;
use App\Repositories\Contracts\OrderRepositoryContract;
use App\Repositories\Contracts\ProductRepositoryContract;
use App\Services\Contracts\InvoicesServiceContract;
use App\Repositories\ImageRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Services\Contracts\PaymentServiceContract;
use App\Services\PaypalService;
use App\Services\InvoicesService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ProductRepositoryContract::class => ProductRepository::class,
        ImageRepositoryContract::class => ImageRepository::class,
        OrderRepositoryContract::class => OrderRepository::class,
        PaymentServiceContract::class => PaypalService::class,
        InvoicesServiceContract::class => InvoicesService::class,
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
