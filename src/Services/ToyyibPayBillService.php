<?php

namespace ZarulZubir\ToyyibPay\Services;

use GuzzleHttp\Client;

class ToyyibPayBillService
{
    private $url;
    private $client;

    public function __construct()
    {
        $this->url = config('toyyibpay.staging') ? 'https://dev.toyyibpay.com/' : 'https://toyyibpay.com/';
        $this->client = new Client([
            'headers' => [
                'Authorization' => ''
            ]
        ]);
    }

    protected function getUrl($path)
    {
        return $this->url.$path;
    }

    public function getBank()
    {
        $request = $this->client->get($this->getUrl('index.php/api/getBank'));
        return json_decode($request->getBody()->getContents(), true);
    }

    public function createBill(array $data)
    {
        $data = array_merge($data, [
            'userSecretKey' => config('toyyibpay.secret'),
            'billSplitPayment' => 0,
            'billPaymentChannel' => 2,
            'billPriceSetting'=> 1,
            'billPayorInfo' => 0,
            'billChargeToCustomer' => 2,
            'categoryCode' => config('toyyibpay.category'),
        ]);
        $request = $this->client->post($this->getUrl('index.php/api/createBill'), [
            'form_params' => $data,
        ]);

        $body = $request->getBody()->getContents();

        $json = json_decode($body, true);

        if (!empty($json['status']) && $json['status'] == 'error') {
            throw new \Exception($json['msg']);
        }
        return $json;
    }

    public function getBillTransactions(array $data)
    {
        $data = array_merge($data, [
            'billpaymentStatus' => '1',
        ]);

        $request = $this->client->post($this->getUrl('api/getBillTransactions'), [
            'form_params' => $data,
        ]);

        $body = $request->getBody()->getContents();

        return json_decode($body, true);
    }
}
