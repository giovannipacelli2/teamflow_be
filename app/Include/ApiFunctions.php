<?php

namespace App\Include;

use App\Exceptions\JsonRespException;
use Illuminate\Http\Request;
use App\Http\Controllers\ResponseJson;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ApiFunctions
{

    /*--------------------------------TEXT-PROCESSING----------------------------------*/

    /**
     * @param array | string $data
     * @param "lower" | "upper" | "ucfirst" $trasform
     * @param array{string} $associativeKeys
    */
    public static function textProcessing($data, $transform = "lower", $associativeKeys=[])
    {
        $fn = function($text) use ($transform){
            $text = strtolower(trim($text));

            switch($transform){
                case 'lower':
                    return $text;
                case 'upper':
                    return strtoupper($text);
                case 'ucfirst':
                    return ucfirst($text);
                default:
                    return $text;
            }
        };

        if (is_array($data)) {

            if (count($associativeKeys)>0){
                foreach($associativeKeys as $key){

                    if (isset($data[$key])){
                        $data[$key] = $fn($data[$key]);
                    }
                }

                return $data;
            }

            return array_map($fn, $data);
        }
        elseif (is_string($data)) {
            return $fn($data);
        }

        return false;
    }

    /*--------------------------------SERIALIZE-FLOATS---------------------------------*/

    public static function serializeFloat($floatValue)
    {
        return number_format($floatValue, 2, '.', '');
    }

    /*----------------CONVERT-TO-CAMEL-CASE-------------------*/

    public static function camelToSnake($input) {
        // Inserisce un underscore prima delle lettere maiuscole e converte tutto in minuscolo
        return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $input));
    }
    /*---------CONVERT-ASSOCIATIVE-ARRAY-TO-SNAKE-CASE--------*/

    public static function arrCamelToSnake( array $arr) : array {
        $res = [];

        foreach (array_keys($arr) as $field){
            $f = self::camelToSnake($field);

            if (isset($arr[$field])){
                $res[$f] = $arr[$field];
            }
        }

        return $res;
    }

    /*----------------CONVERT-TO-SNACK-CASE-------------------*/

    public static function snakeToCamel($input, $capitalizeFirstCharacter = false) {
        // Converte il snake_case in camelCase
        $str = str_replace('_', '', ucwords($input, '_'));
    
        if (!$capitalizeFirstCharacter) {
            $str = lcfirst($str);
        }
    
        return $str;
    }

    /*----------------CARBON-VALIDATE-DATE--------------------*/

    public static function carbonValidateDate($date): bool {

        try {
            Carbon::createFromIsoFormat('YYYY-MM-DD', $date);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    /*-------CREATE-SORTING-ARRAYS-/-SORTING-INSTANCE---------*/

    public static function getSorting(array $sortByArr, array $sortValueArr, $instance = null){

        if ( count($sortByArr) > 0 && count($sortValueArr) > 0 ){

            // order fields

            if (!$instance){
                
                return [
                    'sortByArr'=> $sortByArr,
                    'sortValueArr'=> $sortValueArr,
                    'instance'=>null,
                    'isSorted'=>true,
                ];
            } else {
                $res = null;

                $fields = $instance->getModel()->getFields();
    
                for ($i = 0; $i < count($sortByArr); $i++ ){
                    
                    if ($fields && in_array($sortByArr[$i], $fields)){
                        $res = $instance->orderBy($sortByArr[$i], $sortValueArr[$i]);
                    } else if (!$fields) {
                        
                        $res = $instance->orderBy($sortByArr[$i], $sortValueArr[$i]);
                    }
                }

                if ($res){
                    return [
                        'sortByArr'=>[],
                        'sortValueArr'=>[],
                        'instance'=>$res,
                        'isSorted'=>true,
                    ];
                }
    
            }

            
        }

        return [
            'sortByArr'=>[],
            'sortValueArr'=>[],
            'instance'=>null,
            'isSorted'=>false,
        ];

    }

    /*---------------FILTER-ENTITY-INSTANCE-------------------*/

    public static function fiterInstance(array $filterByArr, array $filterValueArr, $instance){

        if ( count($filterByArr) > 0 && count($filterValueArr) > 0 ){

            // filter fields

            $res = null;

            $fields = $instance->getModel()->getFields();
    
            for ($i = 0; $i < count($filterByArr); $i++ ){

                if ($fields && in_array($filterByArr[$i], $fields)){
                        
                    $res = $instance->where($filterByArr[$i], 'ILIKE', '%'. $filterValueArr[$i].'%');
                } else if (!$fields){

                    $res = $instance->where($filterByArr[$i], 'ILIKE', '%'. $filterValueArr[$i].'%');
                }
            }                   
                    
            if ($res){
                return [
                    'instance'=>$res,
                    'isFiltered'=>true,
                ];
            }

            
        }

        return [
            'instance'=>null,
            'isFiltered'=>false,
        ];

    }

    /*--------------LARAVEL-SIMPLE-VALIDATION-----------------*/
    
    public static function simpleValidate(Request $request, $rules, $messages=[]) : array {


        $necessaryFiels = array_keys($rules);

        $validator = null;

        if (count($messages) == 0) {
            $validator = validator($request->all(), $rules);
        } else {
            $validator = validator($request->all(), $rules, $messages);
        }

        // Manage filter errors

        if ($validator->fails()) {

            // STRINGIFY ERROR MESSAGES

            $errors = $validator->errors();

            $msgsArr = [];

            foreach($errors->messages() as $key=>$value){
                $msgs = implode('. ',$value);
                array_push($msgsArr, $key . ': ' . $msgs);
            }

            $msgsStr = implode('. ', $msgsArr);

            throw new JsonRespException($msgsStr, 400, null, $errors);

            return $result;
        }

        // returns validated data

        return (array) $request->only(...$necessaryFiels);
    }
    

    /*-----------------LARAVEL-VALIDATION---------------------*/
    
    public static function validateCreation(Request $request, $rules, $messages=[]) : array {

        $result = [
            'data'=>[],
            'message'=>''
        ];

        $necessaryFiels = array_keys($rules);

        $validator = null;

        if (count($messages) == 0) {
            $validator = validator($request->all(), $rules);
        } else {
            $validator = validator($request->all(), $rules, $messages);
        }

        // Manage filter errors

        if ($validator->fails()) {

            //$message = self::validationErrors($validator->errors());

            $result['message'] = $validator->errors();

            return $result;
        }

        // returns validated data

        $result['data'] = (array) $request->only(...$necessaryFiels);
        return $result;
    }

    public static function validateUpdate(Request $request, $rules, $empty=false, $messages=[]) : array {

        $validator = null;

        $result = [
            'data'=>[],
            'message'=>''
        ];

        if (count($messages) == 0) {
            $validator = validator($request->all(), $rules);
        } else {
            $validator = validator($request->all(), $rules, $messages);
        }

        // Manage filter errors

        if ($validator->fails()) {

            //$message = self::validationErrors($validator->errors());

            $result['message'] = $validator->errors();

            return $result;
        }
        
        // Check the correctness of data from the request

        $accettableFields = array_keys($rules);

        $check = self::updateChecker($request->all(), $accettableFields, $empty);

        if (!$check) {
            $result['message'] = 'Bad request';

            return $result;
        }

        $result['data'] = (array) $request->only(...$accettableFields);
        return $result;
    }

    /*------------------OTHER-VALIDATION----------------------*/

    public static function validateHours($hours) {

        $check = true;
        $permitted = ['start', 'end'];

        $check = ApiFunctions::existsAllParams($hours, $permitted);

        if ($check){

            // validate time format
            foreach ($hours as $key=>$value){
    
                self::validateTime($value);
            }            
        } 

        if(!$check) {
            return ResponseJson::out([], 400, 'Date is invalid.');
        }

    }

    public static function validateTime($time) : bool {

        $rules = [
            'time' => 'required|date_format:H:i',
        ];

        $messages = [
            'time.required' => 'Time is required',
            'time.date_format' => 'Time format is invalid.',
        ];

        $validator = Validator::make(['time' => $time], $rules, $messages);

        if ($validator->fails()) {

            //$message = self::validationErrors($validator->errors());
            $message = $validator->errors();
            return ResponseJson::out([], 400, $message);
        }
        

        return true;
    }

    public static function validationErrors($errors) : string {

        $errors = $errors->toArray();

        $message = '';

        foreach($errors as $msg) {
            $message = $message === '' ? $msg[0] : $message . ' ' . $msg[0];
        }

        return $message;
    }

    // check NOT NULL fields

    // Wants data as key=>value and fields as array of string
    public static function existsAllParams($data, $data_fields, $empty = false)
    {
        //cast sended data in associative array;
        $data = (array) $data;
        
        $check = true;

        // check input data integrity

        foreach ($data_fields as $param) {

            // $param = a NOT NULL field from existing table
            // $data = array to check
            $exists = array_key_exists($param, $data);

            // if param NOT EXISTS or an param has empty string

            if (!$exists || (!$empty && $data[$param] == '')) {
                $check = false;
            }

        }
        return $check;
    }

    /*-------CHECK-IF-THERE-ARE-ANY-INCORRECT-FIELDS----------*/

    // Wants data as associative array and fields as array of string
    public static function validateParams($data, $data_checker, $isEmpty = false)
    {

        //cast sended data in associative array;
        $data = (array) $data;

        $check = true;

        // check input data integrity

        foreach ($data as $field => $value) {

            // $field = key of sended data
            // $data_checker = array with necessary field

            $exists = in_array($field, $data_checker);

            // if param NOT EXISTS

            if (!$exists) {
                $check = false;
            } elseif (!$isEmpty && $value == '') {
                $check = false;
            }

        }

        return $check;
    }

    /*--------------------CHECK-UPDATE------------------------*/

    // Return FALSE if there are all fields
    // Return TRUE if there are some of necessary fields

    public static function updateChecker($data, $data_fields, $empty=false) : bool
    {

        if (!$data) {
            return false;
        }

        if (!$data_fields) {
            return false;
        }

        $validation = self::existsAllParams($data, $data_fields, $empty);

        if (!$validation) {

            $validation = self::validateParams($data, $data_fields, $empty);
            
            if (!$validation) {
                return false;
            }

            return true;
        }

        return $validation;

    }

    /*----------------------CHECK-DATE------------------------*/

    public static function dateGtToday(String $date) : bool {
        $now = Carbon::parse(now());
        $appointmentDate = Carbon::parse($date);

        if ($now->gt($appointmentDate)) {
            return false;
        }

        return true;
    }

    public static function validateDate($date, $format = 'Y-m-d H:i:s')
    {

        $d = \DateTime::createFromFormat($format, $date);

        return $d && $d->format($format) == $date;
    }

    // check data format:
    // It can be 'Y-m-d H:i:s' or 'Y-m-d'

    public static function checkDate($date)
    {

        $validation = self::validateDate($date);

        if (!$validation) {

            if (!self::validateDate($date, 'Y-m-d')) {

                ResponseJson::out([], 400, 'Not valid format of date');
                exit();
            }

        }
    }

    public static function checkCorrectDates(array $date_arr): mixed
    {
        $now = new \DateTime('now');

        $date = [
            'start' => '',
            'end' => '',
        ];

        $count = 0;

        // Creates datatime objects from query data
        try {
            foreach ($date_arr as $key => $value) {

                if ($value != '') {
                    $date[$key] = new \DateTime($value);
                    $count++;
                }
            }
        } catch (\Exception $e) {
            ResponseJson::out([], 400, 'Error in date format!');

            return false;
        }

        // if the data is not there
        if ($count === 0) {

            ResponseJson::out([], 400, "The 'START' and 'END' values ​​cannot be both empty!");

            return false;

        }

        // If there is only one of the two data, it assigns today's date to the missing one

        elseif ($count < count($date)) {

            if ($date['start'] != '' && $date['start'] >= $now) {

                ResponseJson::out([], 400, "the 'START' date cannot be greater than today's date");

                return false;

            } elseif ($date['end'] != '' && $date['end'] <= $now) {

                ResponseJson::out([], 400, "the 'END' date cannot be less than today's date");

                return false;

            }

            if ($date['start'] == '') {
                $date['start'] = $now;
            }
            if ($date['end'] == '') {
                $date['end'] = $now;
            }

        } elseif ($count == count($date)) {

            if ($date['start'] > $date['end']) {

                ResponseJson::out([], 400, "the 'END' date cannot be less than 'START' date");

                return false;
            } elseif ($date['start'] == $date['end']) {

                ResponseJson::out([], 400, "The 'START' date can't be the same as the 'END' date");

                return false;
            }

        }

        return $date;
    }

    /*--------------ERROR/EXCEPTION-MANAGEMENT----------------*/

    public static function writeExceptionString($e)
    {
        $code = $e->getCode();
        $msg = $e->getMessage();
        $file = $e->getFile();
        $line = $e->getLine();

        $date = new \DateTime('now');
        $date = $date->format('Y-m-d H:i:s');

        return "Error: [$code] $msg -" . PHP_EOL . $file . ": line: $line" . PHP_EOL;
    }

}