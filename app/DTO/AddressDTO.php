<?php

namespace App\DTO;

use Illuminate\Contracts\Support\Arrayable;

class AddressDTO extends DTO implements Arrayable
{
    public function __construct(
        public readonly string $city,
        public readonly string $district,
        public readonly string $street,
    ) {}

    public function toArray(): array
    {
        return [
            'city' => $this->city,
            'district' => $this->district,
            'street' => $this->street,
        ];
    }
}
