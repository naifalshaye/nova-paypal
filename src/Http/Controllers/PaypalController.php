<?php

namespace Naif\Paypal\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Paypal;
include 'Paypal.php';

class PayPalController extends Controller
{
    private $paypal;
    private $info;

    public function __construct(){
        $this->paypal = new Paypal(env('NOVA_PAYPAL_USERNAME'), env('NOVA_PAYPAL_PASSWORD'), env('NOVA_PAYPAL_SIGNATURE'));

    }

    public function index(Request $request)
    {
        $days = $request->get('days');
        $count = $request->get('count');
        if (!$days){
            $days = 5;
        }
        else if (!$count){
            $count = 10;
        }

        if (!App::environment('production')) {
            $data = $this->paypal->call('GetBalance');
            $response['balance']['ACK'] = data_get($data,'ACK');
            $response['balance']['L_AMT0'] = data_get($data,'L_AMT0');
            $response['balance']['L_SEVERITYCODE0'] = data_get($data,'L_SEVERITYCODE0');
            $response['balance']['L_ERRORCODE0'] = data_get($data,'L_ERRORCODE0');
            $response['balance']['L_LONGMESSAGE0'] = data_get($data,'L_LONGMESSAGE0');

            $this->info = 'USER=' . env('NOVA_PAYPAL_USERNAME')
                . '&PWD=' . env('NOVA_PAYPAL_PASSWORD')
                . '&SIGNATURE=' . env('NOVA_PAYPAL_SIGNATURE')
                . '&METHOD=TransactionSearch'
                . '&TRANSACTIONCLASS=RECEIVED'
                . '&STARTDATE='.date_create(date('Y-m-d',strtotime("-".$days." days")))->format('c')
                . '&VERSION=94';

            $transactions[] = [];
            $curl = curl_init('https://api-3t.paypal.com/nvp');
            curl_setopt($curl, CURLOPT_FAILONERROR, true);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $this->info);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_POST, 1);
            $result = curl_exec($curl);
            $result = explode("&", $result);

            foreach ($result as $value) {
                $value = explode("=", $value);
                $temp[$value[0]] = $value[1];
            }
            for ($i = 0; $i <= count($temp) / 19; $i++) {
                $transactions['transactions'][$i] = array(
                    "timestamp" => date("Y-m-d", strtotime(urldecode($temp["L_TIMESTAMP" . $i]))),
                    "timezone" => urldecode($temp["L_TIMEZONE" . $i]),
                    "type" => urldecode($temp["L_TYPE" . $i]),
                    "email" => urldecode($temp["L_EMAIL" . $i]),
                    "name" => urldecode($temp["L_NAME" . $i]),
                    "transaction_id" => urldecode($temp["L_TRANSACTIONID" . $i]),
                    "status" => urldecode($temp["L_STATUS" . $i]),
                    "amt" => urldecode($temp["L_AMT" . $i]),
                    "currency_code" => urldecode($temp["L_CURRENCYCODE" . $i]),
                    "fee_amount" => urldecode($temp["L_FEEAMT" . $i]),
                    "net_amount" => urldecode($temp["L_NETAMT" . $i])
                );
            }
        }
        else{
            $response['balance']['ACK'] = 'Success';
            $response['balance']['L_AMT0'] = '464.01';


            $transactions['transactions'][0] = [
                'amt' => "30.00",
                'currency_code' => "USD",
                'email' => "naif.alshaia@gmail.com",
                'fee_amount' => "-0.01",
                'name' => "Naif Alshaia",
                'net_amount' => "0.00",
                'status' => "Completed",
                'timestamp' => date("Y-m-d", strtotime("2018-09-11T19:24:30Z")),
                'timezone' => "GMT",
                'transaction_id' => "0JE45262XN196280D",
                'type' => "Payment"
            ];
            $transactions['transactions'][1] = [
                'amt' => "19.04",
                'currency_code' => "USD",
                'email' => "naif.alshaia@gmail.com",
                'fee_amount' => "-0.01",
                'name' => "Naif Alshaia",
                'net_amount' => "0.00",
                'status' => "Completed",
                'timestamp' => date("Y-m-d", strtotime("2018-09-11T19:24:30Z")),
                'timezone' => "GMT",
                'transaction_id' => "0JE45562XX196211E",
                'type' => "Payment"
            ];
            $transactions['transactions'][2] = [
                'amt' => "20.00",
                'currency_code' => "USD",
                'email' => "naif.alshaia@gmail.com",
                'fee_amount' => "-0.01",
                'name' => "Naif Alshaia",
                'net_amount' => "0.00",
                'status' => "Completed",
                'timestamp' => date("Y-m-d", strtotime("2018-09-10T19:24:30Z")),
                'timezone' => "GMT",
                'transaction_id' => "0JE45569JU1962811F",
                'type' => "Payment"
            ];
            $transactions['transactions'][3] = [
                'amt' => "07.21",
                'currency_code' => "USD",
                'email' => "naif.alshaia@gmail.com",
                'fee_amount' => "-0.01",
                'name' => "Naif Alshaia",
                'net_amount' => "0.00",
                'status' => "Completed",
                'timestamp' => date("Y-m-d", strtotime("2018-09-09T19:24:30Z")),
                'timezone' => "GMT",
                'transaction_id' => "0JE45564NI196123W",
                'type' => "Payment"
            ];
            $transactions['transactions'][4] = [
                'amt' => "120.00",
                'currency_code' => "USD",
                'email' => "naif.alshaia@gmail.com",
                'fee_amount' => "-0.01",
                'name' => "Naif Alshaia",
                'net_amount' => "0.00",
                'status' => "Completed",
                'timestamp' => date("Y-m-d", strtotime("2018-09-02T19:24:30Z")),
                'timezone' => "GMT",
                'transaction_id' => "0JE45562YN196299E",
                'type' => "Payment"
            ];
            $transactions['transactions'][5] = [
                'amt' => "220.00",
                'currency_code' => "USD",
                'email' => "naif.alshaia@gmail.com",
                'fee_amount' => "-0.01",
                'name' => "Naif Alshaia",
                'net_amount' => "0.00",
                'status' => "Completed",
                'timestamp' => date("Y-m-d", strtotime("2018-08-30T19:24:30Z")),
                'timezone' => "GMT",
                'transaction_id' => "0JE45562YN196933K",
                'type' => "Payment"
            ];
            $transactions['transactions'][6] = [
                'amt' => "10.00",
                'currency_code' => "USD",
                'email' => "naif.alshaia@gmail.com",
                'fee_amount' => "-0.01",
                'name' => "Naif Alshaia",
                'net_amount' => "0.00",
                'status' => "Completed",
                'timestamp' => date("Y-m-d", strtotime("2018-08-30T19:24:30Z")),
                'timezone' => "GMT",
                'transaction_id' => "0JE45562YN196280V",
                'type' => "Payment"
            ];
            $transactions['transactions'][7] = [
                'amt' => "18.28",
                'currency_code' => "USD",
                'email' => "naif.alshaia@gmail.com",
                'fee_amount' => "-0.01",
                'name' => "Naif Alshaia",
                'net_amount' => "0.00",
                'status' => "Completed",
                'timestamp' => date("Y-m-d", strtotime("2018-08-24T19:24:30Z")),
                'timezone' => "GMT",
                'transaction_id' => "0JE45562YN196212F",
                'type' => "Payment"
            ];
            $transactions['transactions'][8] = [
                'amt' => "05.00",
                'currency_code' => "USD",
                'email' => "naif.alshaia@gmail.com",
                'fee_amount' => "-0.01",
                'name' => "Naif Alshaia",
                'net_amount' => "0.00",
                'status' => "Completed",
                'timestamp' => date("Y-m-d", strtotime("2018-08-22T19:24:30Z")),
                'timezone' => "GMT",
                'transaction_id' => "0JE45562YN196222D",
                'type' => "Payment"
            ];
            $transactions['transactions'][9] = [
                'amt' => "14.12",
                'currency_code' => "USD",
                'email' => "naif.alshaia@gmail.com",
                'fee_amount' => "-0.01",
                'name' => "Naif Alshaia",
                'net_amount' => "0.00",
                'status' => "Completed",
                'timestamp' => date("Y-m-d", strtotime("2018-08-18T19:24:30Z")),
                'timezone' => "GMT",
                'transaction_id' => "0JE45562YN196290P",
                'type' => "Payment"
            ];
        }

//        $response['transactions'] = array_slice($transactions['transactions'], -$count));
        $response['transactions'] = array_slice($transactions['transactions'], 0, $count);
        return $response;
    }
}