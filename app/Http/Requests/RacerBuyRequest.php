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
    public function rules()
    {
        $user = Auth::user();
        $walletUSD = $user->neededWallet(CurrencyType::USD);

        $walletService = new WalletService;
        $balanceUSD = $walletService->getWalletBalance($walletUSD);

        $racer = $this->racer;

        return [
            'racer' => [
                'exists:racers, id'
            ]
        ];
    }
}
