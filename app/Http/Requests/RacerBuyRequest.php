<?php

namespace App\Http\Requests;

use App\Models\Racer;
use App\Enums\CurrencyType;
use Illuminate\Validation\Rule;
use App\Rules\SufficientBalance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property Racer $racer;
 */
class RacerBuyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'price' => ['required', new SufficientBalance(Auth::user(), $this->racer->price)]
        ];
    }

    protected function prepareForValidation(): void
    {
        if (is_null($this->price)) {
        $this->merge(['price' => $this->racer->price]);
        }
    }
}
