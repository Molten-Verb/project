<?php

namespace App\Http\Requests;

use App\Models\Racer;
use Illuminate\Validation\Rule;
use App\Rules\SufficientBalance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property Racer $racer;
 */
class EnoughBalanceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'price' => ['required', 'numeric', new SufficientBalance(Auth::user())]
        ];
    }

    protected function prepareForValidation(): void
    {
        if (is_null($this->price)) { // $value отправляется в SufficientBalance
            $this->merge(['price' => $this->racer->price]);
        }
    }
}
