<?php

use App\Enums\CurrencyEnum;
use Illuminate\Http\Response;
use App\CurrencyConverter\Converter;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

if (!function_exists('exchange_to_currency')) {
    /**
     * 轉換至新幣種的價格
     *
     * @param int $price
     * @param CurrencyEnum $currency
     * @return int
     */
    function exchange_to_currency(int $price, CurrencyEnum $currency): int
    {
        return app(Converter::class)->exchangePrice($price, $currency);
    }
}

if (!function_exists('throwValidateException')) {
    /**
     * 拋出驗證錯誤
     *
     * @param Validator $validator
     * @return void
     */
    function throwValidateException(Validator $validator): void
    {
        throw new ValidationException(
            $validator,
            new Response([
                'errors' => $validator->errors(),
            ], 400)
        );
    }
}
