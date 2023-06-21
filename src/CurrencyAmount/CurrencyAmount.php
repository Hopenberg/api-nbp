<?php

namespace Hopcio\Apinbp\CurrencyAmount;

use InvalidArgumentException;
use Hopcio\Apinbp\ExchangeRate\ExchangeRate;
use Hopcio\Apinbp\CurrencyAmount\CurrencyAmountChangedEvent;

class CurrencyAmount {

    private float $amount;
    private string $currency;

    public function __construct($currency, $amount) {
        $this->currency = $currency;
        $this->amount = $amount;
    }

    public function exchange(ExchangeRate $exchangeRate): CurrencyAmountChangedEvent {
        if ($this->currency !== $exchangeRate->getFrom()) {
            throw new InvalidArgumentException("Wrong currency given");
        }

        $old = clone $this;

        $this->amount = $this->amount * $exchangeRate->getRate();
        $this->currency = $exchangeRate->getTo();

        return new CurrencyAmountChangedEvent($old, $this, $exchangeRate);
    }

    public function getAmount() {
        return $this->amount;
    }

    public function getCurrency() {
        return $this->currency;
    }
}

