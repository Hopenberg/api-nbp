<?php

namespace Hopcio\Apinbp\ExchangeRate;

use Hopcio\Apinbp\Tools\DBConnection;

class ExchangeHistory {

    private string $from;
    private string $to;
    private float $rate;
    private float $amountAfter;

    public function __construct(string $from, string $to, float $rate, float $amountAfter) {
        $this->from = $from;
        $this->to = $to;
        $this->rate = $rate;
        $this->amountAfter = $amountAfter;
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

    public function getAmountAfter(): string {
        return $this->amountAfter;
    }

    public static function getAll(): array {
        $db = new DBConnection();
        $result = $db->query("SELECT * FROM exchanges");

        if (empty($result)) {
            return [];
        }
        else {
            $histories = [];

            foreach ($result as $history) {
                $histories[] = new ExchangeHistory(
                    $history['c_from'], 
                    $history['c_to'], 
                    $history['currency_rate'],
                    $history['amount_after']
                );
            }

            return $histories;
        }
    }
}