<?php

namespace Naif\Paypal\Http\Controllers;

use Illuminate\Routing\Controller;
use Paypal;

include 'Paypal.php';

class PayPalController extends Controller
{
    public function index()
    {
        $paypal = new Paypal(env('NOVA_PAYPAL_USERNAME'), env('NOVA_PAYPAL_PASSWORD'), env('NOVA_PAYPAL_SIGNATURE'));
        $response = $paypal->call('GetBalance');
        $response['show_logo'] = env('NOVA_PAYPAL_SHOW_LOGO');
        return $response;
    }
}