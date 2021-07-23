<?php

namespace App\Providers;

use Braintree\Gateway;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(Gateway::class, function($app){
            return new Gateway($app['config']['braintree']);
        });

        Collection::macro('byStatus', function ($status) {
            return $this->filter(function ($value) use ($status) {
                return $value->status_id == $status;
            });
        });
    }
}
