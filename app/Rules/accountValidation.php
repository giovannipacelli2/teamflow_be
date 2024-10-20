<?php

namespace App\Rules;

use App\Models\Account;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\App;

class accountValidation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $language = App::getLocale();

        $messages = [
            'en'=>[
                'account' => 'Inserted :attribute is not exists',
            ],
            'it'=>[
                'account' => 'L\':attribute inserito non esiste',
            ],
        ];

        $check = Account::where('id', (string) $value);
        dd($check->get()->toArray());

        if (!$check){
            $fail($messages[$language]['account']);
        }
    }
}
