<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
        $this->app->bind('App\Interface\Services\PostServiceInterface', 'App\Services\PostService');
        $this->app->bind('App\Interface\Services\UserServiceInterface', 'App\Services\UserService');
        $this->app->bind('App\Interface\Services\PasswordServiceInterface', 'App\Services\PasswordService');

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}