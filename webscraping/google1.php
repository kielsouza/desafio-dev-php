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
$searchBox->sendKeys('praia');
$searchBox->submit();

sleep(5);

?>
