# Nova PayPal Card

A Laravel Nova card to display PayPal current balance and latest transactions.

## Installation:
First you must install naif/laravel-paypal [naif/laravel-paypal](https://github.com/naifalshaye/laravel-paypal) into your Laravel app.

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
  
## Support:
naif@naif.io

https://www.linkedin.com/in/naif

## License:
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
