<?php

namespace Hopcio\Apinbp\CurrencyAmount;

use Hopcio\Apinbp\Tools\DBConnection;
use Hopcio\Apinbp\ExchangeRate\ExchangeRate;
use Hopcio\Apinbp\CurrencyAmount\CurrencyAmount;

class CurrencyAmountChangedEvent {

    private CurrencyAmount $from;
    private CurrencyAmount $to;
    private ExchangeRate $er;

    public function __construct(CurrencyAmount $from, CurrencyAmount $to, ExchangeRate $er) {
        $this->from = $from;
        $this->to = $to;
        $this->er = $er;
    }

    public function handle() {
        $conn = new DBConnection();
        $conn->execute(
            "INSERT INTO exchanges (c_from, c_to, amount_after, currency_rate) VALUES (?, ?, ?, ?)",
            [$this->from->getCurrency(), 
                $this->to->getCurrency(), 
                $this->to->getAmount(), 
                $this->er->getRate()]
        );
    }

}