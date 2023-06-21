<?php

namespace Hopcio\Apinbp\ExchangeRate;

use Hopcio\Apinbp\Tools\DBConnection;

class ExchangeRateService
{

    public function downloadRates()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://api.nbp.pl/api/exchangerates/tables/A?format=json");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);

        $result = json_decode($result, associative: true);

        $date = $result[0]['effectiveDate'];

        $db = new DBConnection();

        $db->execute("DELETE FROM rates", []);

        foreach ($result[0]['rates'] as $rate) {
            $db->execute(
                "INSERT INTO rates (c_from, c_to, rate, date) VALUES (?, ?, ?, ?)",
                [$rate['code'], 'PLN', $rate['mid'], $date]
            );
        }

        curl_close($ch);
    }
}
