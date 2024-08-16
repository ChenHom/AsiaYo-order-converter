<?php

namespace App\DTO;

use Illuminate\Foundation\Http\FormRequest;

abstract class DTO
{
    /**
     * @param FormRequest $request
     */
    public static function fromRequest(FormRequest $request)
    {
        return new static(
            ...array_values($request->safe()->toArray())
        );
    }
}
