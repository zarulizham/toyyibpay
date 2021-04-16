<?php

namespace ZarulZubir\ToyyibPay;

use Illuminate\Support\ServiceProvider;

class ToyyibPayServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/toyyibpay.php' => config_path('toyyibpay.php'),
        ], 'toyyibpay');
    }

    public function register()
    {
        parent::register();
    }
}
