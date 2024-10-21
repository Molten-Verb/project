<?php

namespace App\Http\Requests;

use App\Models\Racer;
use App\Enums\CurrencyType;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\Wallet\WalletService;
use Illuminate\Foundation\Http\FormRequest;

class RacerBuyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = Auth::user();
        $walletUSD = $user->neededWallet(CurrencyType::USD);

        $walletService = new WalletService;
        $balanceUSD = $walletService->getWalletBalance($walletUSD);

        $racer = $this->racer;

        return [
            'balanceUSD' =>[
                'required',
                function (string $attribute, mixed $value, Closure $fail) use ($balanceUSD, $racer) {
                    if ($balanceUSD < $racer->value('price')) {
                        $fail("Недостаточно средств");
                    }
                }
            ]
        ];
    }
}
