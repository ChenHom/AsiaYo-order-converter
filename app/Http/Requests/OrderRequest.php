<?php

namespace App\Http\Requests;

use App\Enums\CurrencyEnum;
use Illuminate\Http\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'string'],
            'name' => ['required', 'string'],
            'address' => ['required', 'array'],
            'address.city' => ['required', 'string'],
            'address.district' => ['required', 'string'],
            'address.street' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'currency' => ['required', 'string', 'in:' . implode(
                ',',
                array_map(fn($i) => $i->value, CurrencyEnum::cases())
            )]
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'id.required' => 'ID is required',
            'name.required' => 'Name is required',
            'address.required' => 'Address is required',
            'address.city.required' => 'City is required',
            'address.district.required' => 'District is required',
            'address.street.required' => 'Street is required',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be numeric',
            'currency.required' => 'Currency is required',
            'currency.in' => 'Currency format is wrong',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throwValidateException($validator);
    }
}
