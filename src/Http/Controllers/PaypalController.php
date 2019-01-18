<?php

namespace Naif\Paypal\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Naif\LaravelPayPal\LaravelPayPal;


class PayPalController extends Controller
{
    public function index(Request $request)
    {
        $days = $request->get('days');
        $count = $request->get('count');
        $paypal = new LaravelPayPal();
        $response['balance'] = $paypal->getBalance();
        $response['transactions'] = $paypal->getTransactions($days,$count);
        return $response;
    }
}