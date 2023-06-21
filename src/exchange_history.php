<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Hopcio\Apinbp\ExchangeRate\ExchangeHistory;

$histories = ExchangeHistory::getAll();

echo '<a href="index.php">Powrót</a>
<table>
<tr>
<th>Z</th>
<th>Do</th>
<th>Kurs</th>
<th>Wartość po przewalutowaniu</th>
</tr>';

foreach ($histories as $history) {
    echo "<tr>";
    echo "<td>{$history->getFrom()}</td>";
    echo "<td>{$history->getTo()}</td>";
    echo "<td>{$history->getRate()}</td>";
    echo "<td>{$history->getAmountAfter()}</td>";
    echo "</tr>";
}

echo "</table>";