<?php

namespace ZarulZubir\ToyyibPay\Providers;

use Illuminate\Support\ServiceProvider;
use ZarulZubir\ToyyibPay\Services\ToyyibPayBillService;

class ToyyibPayServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/toyyibpay.php' => config_path('toyyibpay.php'),
        ], 'toyyibpay-config');

        if ($this->app->runningInConsole()) {
            // Export the migration
            if (! class_exists('CreateToyyibPayBillsTable')) {
                $this->publishes([
                    __DIR__ . '/../../database/migrations/2020_10_01_220707_create_toyyib_pay_bills_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_toyyib_pay_bills_table.php'),
                    // you can add any number of migrations here
                  ], 'toyyibpay-migrations');
            }
        }
    }

    public function register()
    {
        parent::register();

        $this->app->bind('toyyibpaybillservice', function ($app) {
            return new ToyyibPayBillService();
        });
    }
}
