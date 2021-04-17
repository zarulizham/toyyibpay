<?php
namespace ZarulZubir\ToyyibPay\Facades;

use Illuminate\Support\Facades\Facade;

class ToyyibPayBillService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'toyyibpaybillservice';
    }
}
