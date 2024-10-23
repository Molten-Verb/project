<?php

namespace App\Http\Requests;

use App\Models\Racer;
use App\Enums\CurrencyType;
use Illuminate\Validation\Rule;
use App\Rules\SufficientBalance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class RacerBuyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $balanceUSD = (float) $this->balanceUSD;
        $racer = $this->racer;

        return [
            'balanceUSD' => ['required', new SufficientBalance($balanceUSD, $racer->price)]
        ];
    }
}
