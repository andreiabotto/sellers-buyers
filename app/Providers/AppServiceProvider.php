<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Managers\Interfaces\ISenderManager', 'App\Managers\SenderSmsManager');
        $this->app->bind('App\Managers\Interfaces\IAuthorizeTransactionManager', 'App\Managers\MockyAuthorizerManager');
        $this->app->bind('App\Repository\Interfaces\IRepositoryFactory', 'App\Repository\RepositoryFactory');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
