# buscape-sdk

### Full import

To run a full proccess example.

```php
<?php

require "vendor/autoload.php";

use Mobly\Buscape\Sdk\Client;
use Mobly\Buscape\Sdk\Collection\ProductCollection;

$collection = new ProductCollection();

// Maybe can be have more mandatory fields
$products = [
    [
        'sku' => 'AAA-123',
        'title' => 'Product Title One'
    ],
    [
        'sku' => 'AAA-123',
        'title' => 'Product Title Two'
    ]
];

foreach ($products as $product) {
    $collection->add($product);
}

$api = new Client([
    'app_token' => 'your_token',
    'auth_token' => 'your_auth_token',
]);

$response = $api->loadProducts($collection);

print_r($response);

```


### Partial import

To run a partial proccess example.

```php
$collection = new InventoryCollection();
foreach ($products as $product) {
    $buscapeProduct = new Inventory($product->toArray());
    $collection->add($buscapeProduct);
}

$api = new Client([
    'app_token' => 'your_token',
    'auth_token' => 'your_auth_token',
]);

$response = $api->inventoryUpdate($collection);

print_r($response);
```
