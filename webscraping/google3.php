<?php
require_once('../vendor/autoload.php');

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverDimension;

$host = 'http://localhost:9515/';
$capabilities = DesiredCapabilities::chrome();
$driver = RemoteWebDriver::create($host, $capabilities);

$driver->get('https://www.vtsolucoes.com.br');

$dimension = new WebDriverDimension(1552, 832);
$driver->manage()->window()->setSize($dimension);

$blogButton = $driver->findElement(WebDriverBy::xpath('//nav[2]/ul/li[6]/a'));
$blogButton->click();
sleep(5);

$titleElement = $driver->findElement(WebDriverBy::xpath('/html/body/section[1]/div/div/div[1]/div[1]/div/div/h3'));
$title = $titleElement->getText();
$overviewElement = $driver->findElement(WebDriverBy::xpath('/html/body/section[1]/div/div/div[1]/div[1]/div/div/p'));
$overview = $overviewElement->getText();
$imgElement = $driver->findElement(WebDriverBy::xpath('/html/body/section[1]/div/div/div[1]/div[1]/div/div/div[1]/img'));
$imgURL = $imgElement->getAttribute('src');

echo "Título: " . $title . "<br>";
echo "Resumo: " . $overview . "<br>";
echo "URL da imagem: " . $imgURL . "<br>";

$driver->quit();

?>
