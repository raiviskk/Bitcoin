<?php

require_once 'vendor/autoload.php';
use App\Api;
use GuzzleHttp\Exception\GuzzleException;

$api = new Api();

echo "Enter a date (YYYY-MM-DD): ";
$date = trim(fgets(STDIN));

try {
    $bitcoinPrice = $api->getPriceByDate($date);
} catch (GuzzleException|JsonException $e) {
}

echo "------------------------" . PHP_EOL;
if ($bitcoinPrice) {
    echo "Bitcoin Price on {$bitcoinPrice->getDate()}: \${$bitcoinPrice->getPrice()}" .PHP_EOL;
} else {
    echo "Bitcoin price data not available for the entered date." .PHP_EOL;
}
echo "------------------------" . PHP_EOL;
