<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Models\Account;

// Custom static class
use App\Include\ApiFunctions;
use App\Include\SortFilter;
use App\Translations\Translations;

class AccountController extends Controller
{   
    private static $MODEL_CLASS = Account::class;
    private $validationMsgs;
    private $genericMsgs;
    private $MODEL;

    public function __construct()
    {
        $this->MODEL = new self::$MODEL_CLASS();
        $this->validationMsgs = Translations::getValidations(self::$MODEL_CLASS);
        $this->genericMsgs = Translations::getMessages('generic');
    }

    public function getAllAccounts(Request $request) {

        /*----------------------------------AUTHORIZATION----------------------------------*/

        $auth = Gate::inspect('viewAny', self::$MODEL_CLASS);

        if (!$auth->allowed()) {

            return ResponseJson::response([], $auth->status(), $auth->message());
        }

        /*--------------------------------GET-QUERY-STRING---------------------------------*/

        $limit = $request->query('limit') ? (int) $request->query('limit') : 5;

        /*--------------------------------FILTERING/SORTING--------------------------------*/

        $model = $this->MODEL->select('*');

        SortFilter::sortFilter($request, $model);

        /*---------------------------------PAGINATE-RESULT---------------------------------*/
        
        try {
    
            // paginate data
            $model = $model->paginate($limit)->toArray();

        } catch (\Exception $e) {

            return ResponseJson::response([], 500, $this->genericMsgs['quert_fail']);
        }

        return ResponseJson::response($model);
    }

    public function getAllUsernames(Request $request) {

        /*----------------------------------AUTHORIZATION----------------------------------*/

        $auth = Gate::inspect('viewAnyUsernames', self::$MODEL_CLASS);

        if (!$auth->allowed()) {

            return ResponseJson::response([], $auth->status(), $auth->message());
        }

        /*--------------------------------GET-QUERY-STRING---------------------------------*/

        $limit = $request->query('limit') ? (int) $request->query('limit') : 5;

        /*--------------------------------FILTERING/SORTING--------------------------------*/

        $model = $this->MODEL->select('id', 'username');

        SortFilter::sortFilter($request, $model);

        /*---------------------------------PAGINATE-RESULT---------------------------------*/
        
        try {
    
            // paginate data
            $model = $model->paginate($limit)->toArray();

        } catch (\Exception $e) {

            return ResponseJson::response([], 500, $this->genericMsgs['query_fail']);
        }

        return ResponseJson::response($model);
    }

    public function getAccount($accountId, Request $request) {

        /*------------------------------CHECK-ID-FROM-REQUEST------------------------------*/

        $model = $this->MODEL->find($accountId);

        if (!$model) {

            return ResponseJson::response([], 404, $this->genericMsgs['not_found']);
        }

        /*----------------------------------AUTHORIZATION----------------------------------*/
        
        $auth = Gate::inspect('viewSingle', [self::$MODEL_CLASS, $accountId]);

        if (!$auth->allowed()) {

            return ResponseJson::response([], $auth->status(), $auth->message());
        }

        /*--------------------------------POSITIVE-RESPONSE--------------------------------*/

        return ResponseJson::response($model);
    }

    public function getAccountInfo($accountId, Request $request) {

        /*------------------------------CHECK-ID-FROM-REQUEST------------------------------*/

        $model = $this->MODEL->find($accountId);

        if (!$model) {

            return ResponseJson::response([], 404, $this->genericMsgs['not_found']);
        }

        /*----------------------------------AUTHORIZATION----------------------------------*/
        
        $auth = Gate::inspect('viewSingleDetails', [self::$MODEL_CLASS, $accountId]);

        if (!$auth->allowed()) {

            return ResponseJson::response([], $auth->status(), $auth->message());
        }

        $model = $model->select('name', 'surname')->where('id', $accountId)->get()->toArray()[0];

        /*--------------------------------POSITIVE-RESPONSE--------------------------------*/

        return ResponseJson::response($model);
    }

    public function createAccount(Request $request){

        /*------------------------------------FUNCTION-------------------------------------*/

        $rules = [
            'username' => 'required|string|min:5|max:255|unique:accounts',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:accounts',
            'surname' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ];

        $data = ApiFunctions::simpleValidate($request, $rules, $this->validationMsgs);

        $data = ApiFunctions::textProcessing($data, "lower" ,['username', 'email']);
        $data = ApiFunctions::textProcessing($data, "ucfirst" ,['name', 'surname']);

        /*-------------------------------CREATE-NEW-ACCOUNT--------------------------------*/

        $modelObj = [
            'username' => $data['username'],
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ];


        try{
            $created = $this->MODEL->create($modelObj);
            $lastId = [
                'id' => $created->id
            ];

            if (!$created) {
                return ResponseJson::response([], 500, $this->genericMsgs['post_unsucc']);
            }
            
        } catch (\Exception $e){
            
            return ResponseJson::response([], 500, $this->genericMsgs['query_fail']);
        }
        
        /*--------------------------------POSITIVE-RESPONSE--------------------------------*/
        
        return ResponseJson::response($lastId, 201, $this->genericMsgs['post_succ']);
    }

    public function updateAccount($accountId, Request $request){

        /*----------------------------------AUTHORIZATION----------------------------------*/

        $auth = Gate::inspect('update', [self::$MODEL_CLASS, $accountId]);

        if (!$auth->allowed()) {

            return ResponseJson::response([], $auth->status(), $auth->message());
        }

        /*------------------------------CHECK-ID-FROM-REQUEST------------------------------*/

        $model = $this->MODEL->find($accountId);

        if (!$model) {

            return ResponseJson::response([], 404, $this->genericMsgs['not_found']);
        }
        
        $currentModelData = $model->where('id', $accountId)->get()->toArray()[0];

        /*--------------------------------VALIDATE-USERNAME--------------------------------*/


        if ($currentModelData['username'] === $request['username']){
            unset($request['username']);
        }

        /*---------------------------------VALIDATE-EMAIL----------------------------------*/

        if ($currentModelData['email'] === $request['email']){
            unset($request['email']);
        }

        /*---------------------------------DATA-VALIDATION---------------------------------*/

        // Filter the inserted data

        $rules = [
            'username' => 'string|min:5|max:255|unique:accounts',
            'name' => 'string|max:255',
            'surname' => 'string|max:255',
            'email' => 'email|max:255|unique:accounts',
            'password' => 'string|min:6',
        ];

        $data = ApiFunctions::simpleValidate($request, $rules, $this->validationMsgs);

        /*---------------------------------HASH-PASSWORD-----------------------------------*/

        /// hashing password if exists "password" field

        if (isset($data['password'])){
            $data['password'] = Hash::make($data['password']);
        }

        /*---------------------------------INSERT-AUTHOR-----------------------------------*/

        // Update author 

        $current = Auth::user();

        $data['author'] = $current->username;

        /*---------------------------------STORE-DATA-IN-DB--------------------------------*/

        try{
            //Update account
            $model->update($data);

        } catch (\Exception $e) {
            return ResponseJson::response([], 500, $this->genericMsgs['put_unsucc']);
        }
        
        /*---------------------------------POSITIVE-RESPONSE-------------------------------*/
        
        return ResponseJson::response([], 200, $this->genericMsgs['put_succ']);
    }

    public function deleteAccount($accountId, Request $request){

        /*------------------------------CHECK-ID-FROM-REQUEST------------------------------*/

        $model = $this->MODEL->find($accountId);

        if (!$model) {

            return ResponseJson::response([], 404, $this->genericMsgs['not_found']);
        }

        /*----------------------------------AUTHORIZATION----------------------------------*/

        $auth = Gate::inspect('delete', [self::$MODEL_CLASS, $accountId]);

        if (!$auth->allowed()) {

            return ResponseJson::response([], $auth->status(), $auth->message());
        }
        
        /*-------------------------------DELETE-MODEL-IN-DB--------------------------------*/

        $deleted = $model->forceDelete();

        if (!$deleted) {

            return ResponseJson::response([], 500, $this->genericMsgs['del_unsucc']);
        }
        
        return ResponseJson::response([], 200, $this->genericMsgs['del_succ']);
    }

    /*--------------------------------PRIVATE-FUNCTIONS--------------------------------*/

}