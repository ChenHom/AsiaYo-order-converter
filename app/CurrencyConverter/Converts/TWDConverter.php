<?php
namespace App\CurrencyConverter\Converts;

use App\CurrencyConverter\CurrencyConverterInterface;

class TWDConverter implements CurrencyConverterInterface
{
    /**
     * @inheritDoc
     */
    public function exchangePrice(int $price): int
    {
        $currencyRate = config('currency.TWD.rate');
        return $price * $currencyRate;
    }
}
