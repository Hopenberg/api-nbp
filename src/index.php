<?php

require_once __DIR__ . '/../vendor/autoload.php';

echo '
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>API NBP</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <a href="rates_table.php">Tabela kursów</a>
    <a href="currency_amount_form.php">Formularz dodawania przewalutowania</a>
    <a href="exchange_history.php">Historia przewalutowań</a>
    <a href="download_rates.php">Pobierz kursy</a>
  </body>
</html>
';
