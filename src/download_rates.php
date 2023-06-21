<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Hopcio\Apinbp\ExchangeRate\ExchangeRateService;

echo '<a href="index.php">Powrót</a>';

$ers = new ExchangeRateService();
$ers->downloadRates();

echo '<br>Kursy pobrane!<br>';