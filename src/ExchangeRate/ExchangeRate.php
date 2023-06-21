<?php

namespace Hopcio\Apinbp\ExchangeRate;

use Hopcio\Apinbp\Tools\DBConnection;

class ExchangeRate {

    private string $date;
    private string $from;
    private string $to;
    private float $rate;

    public function __construct(string $from, string $to, float $rate, string $date) {
        $this->from = $from;
        $this->to = $to;
        $this->rate = $rate;
        $this->date = $date;
    }

    public function getRate(): float {
        return $this->rate;
    }

    public function getTo(): string {
        return $this->to;
    }

    public function getFrom(): string {
        return $this->from;
    }

    public function getDate(): string {
        return $this->date;
    }

    public static function fromDB(string $from, string $to): ?ExchangeRate {
        $db = new DBConnection();
        $result = $db->queryPrepared(
            "SELECT * FROM rates WHERE c_from = ? AND c_to = ?", 
            [$from, $to]
        );

        if (empty($result)) {
            return null;
        }
        else {
            return new ExchangeRate($result[0]['c_from'], $result[0]['c_to'], $result[0]['rate'], $result[0]['date']);
        }
    }

    public static function getAll(): array {
        $db = new DBConnection();
        $result = $db->query("SELECT * FROM rates");

        if (empty($result)) {
            return [];
        }
        else {
            $rates = [];

            foreach ($result as $rate) {
                $rates[] = new ExchangeRate($rate['c_from'], $rate['c_to'], $rate['rate'], $rate['date']);
            }

            return $rates;
        }
    }
}