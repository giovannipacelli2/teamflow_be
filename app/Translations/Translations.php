<?php

namespace App\Translations;

use Exception;
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
        $language = App::getLocale() ?? 'en';

        if ($language){
            if (isset($validations[$language])){
                return $validations[$language];
            }
        } 

        return [];

    }

    public static function getMessages($type) {

        $translationsFile = '';
        if ($type == 'generic'){

            $translationsFile = APP_ROOT . '/app/Translations/messages/'. $type .'s.php';
        } else {
            $translationsFile = APP_ROOT . '/app/Translations/messages/'. $type .'Messages.php';
        }

        $validations = [];

        if (file_exists($translationsFile)){
            $validations = require($translationsFile);
        }

        if (count($validations) === 0) {
            throw new Exception('No translation found');
            exit();
        }
        
        $language = App::getLocale();
        
        if ($language){
            return $validations[$language];
        } else {
            return $validations['en'];
        }
    }
}
