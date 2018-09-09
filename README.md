# Nova PayPal Card

A Laravel Nova card to display PayPal current balance.

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
        new Paypal()
    ];
}
         
```

<img src="https://github.com/naifalshaye/nova-paypal/blob/master/screenshots/with_logo.png" width="700">

<h4>You can hide PayPal logo by setting "NOVA_PAYPAL_SHOW_LOGO=false" in your env</h4>
<img src="https://github.com/naifalshaye/nova-paypal/blob/master/screenshots/without_logo.png" width="700">

<h4>If there are any errors occurs it will appear in the card with error code and description from PayPal</h4>
<img src="https://github.com/naifalshaye/nova-paypal/blob/master/screenshots/errors.png" width="700">

## Get your API access from PayPal website
https://www.paypal.com/businessprofile/mytools/apiaccess/firstparty/signature

Paypal > Profile > Profile and settings > My selling tools > API access > NVP/SOAP API integration (Classic)

<img src="https://github.com/naifalshaye/nova-paypal/blob/master/screenshots/auth.png">

## Add API details to your .env file
```php

NOVA_PAYPAL_USERNAME=##############
NOVA_PAYPAL_PASSWORD=##############
NOVA_PAYPAL_SIGNATURE=#############
NOVA_PAYPAL_SHOW_LOGO=true

```

## Support:
naif@naif.io

https://www.linkedin.com/in/naif

## License:
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
