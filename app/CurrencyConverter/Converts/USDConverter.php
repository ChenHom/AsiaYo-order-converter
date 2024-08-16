<?php

namespace App\CurrencyConverter\Converts;

use App\CurrencyConverter\CurrencyConverterInterface;


class USDConverter implements CurrencyConverterInterface
{
    public function exchangePrice(int $price): int
    {
        $currencyRate = config('currency.USD.rate');
        return $price * $currencyRate;
    }
}
