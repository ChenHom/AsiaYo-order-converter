<?php

namespace App\DTO;

use App\Enums\CurrencyEnum;
use Illuminate\Contracts\Support\Arrayable;

class OrderConvertDTO extends DTO implements Arrayable
{
    public readonly string $id;

    public readonly string $name;

    public readonly AddressDTO $address;

    public readonly int $price;

    public readonly CurrencyEnum $currency;

    public function __construct(string $id, string $name, array $address, int $price, string $currency)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = new AddressDTO($address['city'], $address['district'], $address['street']);
        $this->price = $price;
        $this->currency = CurrencyEnum::from($currency);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address->toArray(),
            'price' => $this->price,
            'currency' => $this->currency->value,
        ];
    }
}
