<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Hopcio\Apinbp\ExchangeRate\ExchangeRate;
use Hopcio\Apinbp\CurrencyAmount\CurrencyAmount;

echo '<a href="index.php">Powrót</a>';

if (isset($_POST['is_sent'])) {

    $ca = new CurrencyAmount($_POST['c_from'], $_POST['amount']);
    $er = ExchangeRate::fromDB($_POST['c_from'], $_POST['c_to']);
    if ($er === null) {
        echo "<br>Niestety nie posiadamy takiego kursu!<br>";
    }
    else {
        $cExchanged = $ca->exchange($er);
        $cExchanged->handle();
        echo "<br>Dodano nowy wpis!<br>";
    }
}

echo '
<form action="currency_amount_form.php" method="post">
    <input type="number" name="amount" id="amount" step="0.01">
    <select name="c_from" id="c_from">
        <option value="GBP">GBP</option>
        <option value="PLN">PLN</option>
        <option value="USD">USD</option>
        <option value="PHP">PHP</option>
    </select>
    <select name="c_to" id="c_to">
        <option value="GBP">GBP</option>
        <option value="PLN">PLN</option>
        <option value="USD">USD</option>
        <option value="PHP">PHP</option>
    </select>
    <input type="hidden" name="is_sent" value="1">
    <button type="submit">Wyślij</button>
</form>
';
