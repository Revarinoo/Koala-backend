<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected function initPaymentGateway(){
        //Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        //Set to Development Sandbox Environment (default). Set to true for Product Environment (accept real)
        \Midtrans\Config::$isProduction = true;

        \Midtrans\Config::$isSanitized = true;

        \Midtrans\Config::$is3ds = true;
    } 
}
