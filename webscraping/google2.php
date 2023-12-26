<?php
require_once('../vendor/autoload.php');

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;

$host = 'http://localhost:9515/';
$capabilities = DesiredCapabilities::chrome();
$driver = RemoteWebDriver::create($host, $capabilities);

$driver->get('https://www.google.com');

$searchBox = $driver->findElement(WebDriverBy::name('q'));
$searchBox->sendKeys('VT Soluções');
$searchBox->submit();

sleep(5);

$phoneElement = $driver->findElement(WebDriverBy::xpath("//span[2]/span/a/span"));
$addressElement = $driver->findElement(WebDriverBy::className("LrzXr"));

$phone = $phoneElement->getText();
$address = $addressElement->getText();

$data = array(
    'telefone' => $phone,
    'endereço' => $address
);

echo '<pre>';
print_r($data);
echo '</pre>';

$driver->quit();

?>
