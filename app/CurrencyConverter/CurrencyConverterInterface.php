<?php

namespace App\CurrencyConverter;

interface CurrencyConverterInterface
{
    /**
     * 將價格轉換成新的幣種的價格
     *
     * @param int $price
     * @return int
     */
    public function exchangePrice(int $price): int;
}
