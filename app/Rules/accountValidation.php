<?php

namespace App\Rules;

use App\Models\Account;
use Closure;
use Exception;
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
                'invalid' => 'Inserted :attribute format is invalid',
            ],
            'it'=>[
                'account' => 'L\':attribute inserito non esiste',
                'invalid' => 'Il formato di :attribute non è valido',
            ],
        ];

        $check = null;
        $invalid = false;

        try{
            
            $check = Account::find((string) $value);
        } catch(Exception $e){

            $invalid = true;
            $fail($messages[$language]['invalid']);
        }

        if (!$check && !$invalid){
            $fail($messages[$language]['account']);
        }
    }
}
