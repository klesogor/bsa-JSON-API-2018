<?php

namespace App\Providers;

use App\Services\CurrencyService;
use App\Services\CurrencyServiceInterface;
use App\Services\MoneyService;
use App\Services\MoneyServiceInterface;
use App\Services\UserService;
use App\Services\UserServiceInterface;
use App\Services\WalletService;
use App\Services\WalletServiceInterface;
use CloudCreativity\LaravelJsonApi\Facades\JsonApi;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        JsonApi::defaultApi('v1');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CurrencyServiceInterface::class,function(){
           return new CurrencyService();
        });

        $this->app->bind(MoneyServiceInterface::class,function(){
            return new MoneyService();
        });

        $this->app->bind(UserServiceInterface::class,function(){
            return new UserService();
        });

        $this->app->bind(WalletServiceInterface::class,function(){
            return new WalletService();
        });
    }
}
