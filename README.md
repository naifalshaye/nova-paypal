# Nova PayPal Card

A Laravel Nova card to display PayPal current balance and latest transactions.

## Installation:

You can install the package in to a Laravel app that uses Nova via composer:

```bash
composer require naif/paypal
```

## Usage:
<h4>Add the below to the card function in app/Providers/NovaServiceProvider.php</h4>

```php

protected function cards()
{
    return [
      (new Paypal())
      
      //you can set days to retrieve transacitons
      (new Paypal())->days(3)  //default last 5 days
      
      //you can specifivy how many transactions to retreive
      (new Paypal())->count(5) //default is 10 transactions
      
      //you can hide PayPal logo
      (new Paypal())->hideLogo(true) //default false
      
     //Example for all options
     (new Paypal())->days(3)->count(5)->hideLogo(true)
    ];
}
         
```

<img src="https://raw.githubusercontent.com/naifalshaye/nova-paypal/master/screenshots/example.png" width="700">

<h4>If there are any errors occurs it will appear in the card with error code and description from PayPal</h4>
<img src="https://raw.githubusercontent.com/naifalshaye/nova-paypal/master/screenshots/error.png" width="700">

A list of all errors you can lookup by error code:
https://developer.paypal.com/docs/classic/api/errors/

## Get your API access from PayPal website
https://www.paypal.com/businessprofile/mytools/apiaccess/firstparty/signature

Paypal > Profile > Profile and settings > My selling tools > API access > NVP/SOAP API integration (Classic)

<img src="https://github.com/naifalshaye/nova-paypal/blob/master/screenshots/auth.png">

The maximum number of transactions that can be returned from a TransactionSearch API call is 100.

## Add API details to your .env file
```php

NOVA_PAYPAL_USERNAME=##############
NOVA_PAYPAL_PASSWORD=##############
NOVA_PAYPAL_SIGNATURE=#############

```

## Support:
naif@naif.io

https://www.linkedin.com/in/naif

## License:
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
