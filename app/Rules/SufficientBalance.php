<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SufficientBalance implements ValidationRule
{
    protected $balance;
    protected $price;

    public function __construct($user, $price)
    {
        $this->balance = $user->balanceUSD();
        $this->price = $price;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->balance < $this->price) {
            $fail("Недостаточно средств USD");
        }
    }
}
