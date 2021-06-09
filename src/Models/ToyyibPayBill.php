<?php

namespace ZarulZubir\ToyyibPay\Models;

use Illuminate\Database\Eloquent\Model;

class ToyyibPayBill extends Model
{
    protected $guarded = [];

    public function getPaymentLinkAttribute()
    {
        if (config('toyyibpay.staging')) {
            return 'https://dev.toyyibpay.com/'.$this->bill_code;
        } else {
            return 'https://toyyibpay.com/'.$this->bill_code;
        }
    }
}
