Zanox PHP API Client
======

A very user-friendly PHP client for [Zanox](https://developer.zanox.com/).

Requirements:
- PHP must be 5.5 or higher.
- [Guzzle 6](https://github.com/guzzle/guzzle) as HTTP client.


## Instalation

Use [Composer](http://getcomposer.org).

Install Composer Globally (Linux / Unix / OSX):

```bash
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
```

Run this Composer command to install the latest stable version of the client, in the current folder:

```bash
composer require izziaraffaele/zanox-php
```

After installing, require Composer's autoloader and you're good to go:

```php
<?php
require 'vendor/autoload.php';
```


## Getting Started

```php
use Zanox\Api;

// Initialize the API
$api = new Api([
    'connectId' => 'your-connect-id',
    'privateKey' => 'your-private-key'
],'https://api.zanox.com/json','2011-03-01');

// Get a specific resource ( ONLY REPORTS AVAILABLE FOR NOW )
$reports = $api->resource('reports');

$reports->getLeadsByDate( DateTime $date, array $query = null)
$reports->getLeadsById( $id, array $query = null )
$reports->getSalesByDate( DateTime $date, array $query = null )
$reports->getSalesById( $id, array $query = null )
$reports->getBasic( DateTime $fromDate, DateTime $toDate, array $query = null)


## Docs

Please refer to the source code for now, while a proper documentation is made.