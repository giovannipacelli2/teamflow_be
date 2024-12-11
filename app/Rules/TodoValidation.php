<?php

namespace App\Rules;

use App\Models\Todo;
use Illuminate\Support\Facades\App;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TodoValidation implements ValidationRule
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
                'model' => 'Inserted :attribute is not exists',
                'invalid' => 'Inserted :attribute format is invalid',
            ],
            'it'=>[
                'model' => 'L\':attribute inserito non esiste',
                'invalid' => 'Il formato di :attribute non è valido',
            ],
        ];

        $check = null;
        $invalid = false;

        try{
            
            $check = Todo::find((string) $value);
        } catch(\Exception $e){

            $invalid = true;
            $fail($messages[$language]['invalid']);
        }

        if (!$check && !$invalid){
            $fail($messages[$language]['model']);
        }
    }
}
