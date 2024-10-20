<?php

namespace App\Translations;

use Illuminate\Support\Facades\App;

class Translations
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function getValidations($classModel) {

        $validations = $classModel::getValidations();

        $language = App::getLocale();

        if ($language){

            return $validations[$language];
        } else {
            return $validations['en'];
        }
        
    }
}
