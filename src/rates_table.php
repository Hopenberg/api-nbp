<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Hopcio\Apinbp\ExchangeRate\ExchangeRate;

$rates = ExchangeRate::getAll();

echo '<a href="index.php">Powrót</a>
<table>
<tr>
<th>Z</th>
<th>Do</th>
<th>Kurs</th>
<th>Data</th>
</tr>';

foreach ($rates as $rate) {
    echo "<tr>";
    echo "<td>{$rate->getFrom()}</td>";
    echo "<td>{$rate->getTo()}</td>";
    echo "<td>{$rate->getRate()}</td>";
    echo "<td>{$rate->getDate()}</td>";
    echo "</tr>";
}

echo "</table>";