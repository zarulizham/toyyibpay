<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ToyyibPayBillServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('toyyibpaybillservice', function () {
            return new ZarulZubir\ToyyibPay\Services\ToyyibPayService;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
