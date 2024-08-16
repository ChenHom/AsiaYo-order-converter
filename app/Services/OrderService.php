<?php

namespace App\Services;

use App\DTO\OrderConvertDTO;
use App\Enums\CurrencyEnum;

class OrderService
{
    public function convertOrder(OrderConvertDTO $order): array
    {
        $this->validateOrder($order);

        return [
            'id' => $order->id,
            'name' => $order->name,
            'address' => $order->address->toArray(),
            'price' => exchange_to_currency($order->price, $order->currency),
            'currency' => CurrencyEnum::TWD->value,
        ];
    }

    /**
     * 驗證訂單資料
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    private function validateOrder(OrderConvertDTO $order): void
    {
        $validator = validator($order->toArray(), [
            // name 檢查是否為英文及每個單字首字大寫
            'name' => ['regex:/^[a-zA-Z\s]*$/', function ($attribute, $value, $fail) {
                foreach (explode(' ', $value) as $word) {
                    if (ucfirst($word) !== $word) {
                        $fail('Name is not capitalized');
                        return;
                    }
                }
            }],
            // price 檢查是否超過 2000
            'price' => ['numeric', 'max:2000'],
        ], [
            'name.regex' => 'Name contains non-English characters',
            'price.max' => 'Price is over 2000',
        ]);

        if ($validator->fails()) {
            throwValidateException($validator);
        }
    }
}
