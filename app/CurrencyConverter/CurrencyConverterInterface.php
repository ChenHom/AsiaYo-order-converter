<?php

namespace App\CurrencyConverter;

interface CurrencyConverterInterface
{
    public function exchangePrice(int $price): int;
}
