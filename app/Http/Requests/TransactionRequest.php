<?php

namespace App\Http\Requests;

use App\Enums\CurrencyType;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'currency' => [
                'required',
                Rule::enum(CurrencyType::class)
            ],
            'value' => [
                'required',
                'numeric',
                'min:0.05',
            ]
        ];
    }
}
