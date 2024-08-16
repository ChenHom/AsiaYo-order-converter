<?php

namespace App\CurrencyConverter;

use App\Enums\CurrencyEnum;
use App\CurrencyConverter\Converts\TWDConverter;
use App\CurrencyConverter\Converts\USDConverter;

/**
 * 這個類別的目的是將價格轉換成新的幣種的價格
 * 傳入價格與幣種二種參數
 * 使用幣種取得匯率，並將價格轉換成新的幣種的價格
 */
class Converter
{
    /**
     * 將價格轉換成新的幣種的價格
     *
     * @param int $price
     * @param CurrencyEnum $currency
     * @return int
     */
    public function exchangePrice(int $price, CurrencyEnum $currency): int
    {
        return $this->getConverter($currency)->exchangePrice($price);
    }

    /**
     * 取得匯率轉換器
     *
     * @param CurrencyEnum $currency
     * @return CurrencyConverterInterface
     */
    private function getConverter(CurrencyEnum $currency): CurrencyConverterInterface
    {
        return match ($currency) {
            CurrencyEnum::USD => new USDConverter(),
            CurrencyEnum::TWD => new TWDConverter(),
        };
    }
}
