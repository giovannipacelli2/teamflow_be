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
    private static $MODEL_NAME_UP_FIRST = 'Account';
    private static $MODEL_NAME_LOWER = 'account';
    private static $MODEL_CLASS = Account::class;
    private $MODEL;

    public function __construct()
    {
        $this->MODEL = new self::$MODEL_CLASS();
    }

    public function getAllAccounts(Request $request) {

        /*----------------------------------AUTHORIZATION----------------------------------*/

        $auth = Gate::inspect('viewAny', self::$MODEL_CLASS)->allowed();

        if (!$auth) {

            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
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

            $response = ResponseJson::format([], 'Error while getting the ' . self::$MODEL_NAME_LOWER . 's');

            return response()->json($response, 500);
        }

        $response = ResponseJson::format($model, '');

        return response()->json($response, 200);
    }

    public function getAllUsernames(Request $request) {

        /*----------------------------------AUTHORIZATION----------------------------------*/

        $auth = Gate::inspect('viewAnyUsernames', self::$MODEL_CLASS)->allowed();

        if (!$auth) {

            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
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

            $response = ResponseJson::format([], 'Error while getting the ' . self::$MODEL_NAME_LOWER . 's');

            return response()->json($response, 500);
        }

        $response = ResponseJson::format($model, '');

        return response()->json($response, 200);
    }

    public function getAccount($accountId, Request $request) {

        /*------------------------------CHECK-ID-FROM-REQUEST------------------------------*/

        $model = $this->MODEL->find($accountId);

        if (!$model) {

            $response = ResponseJson::format([], self::$MODEL_NAME_UP_FIRST . ' not found');
            return response()->json($response, 404);
        }

        /*----------------------------------AUTHORIZATION----------------------------------*/
        
        $auth = Gate::inspect('viewSingle', [self::$MODEL_CLASS, $accountId])->allowed();
        
        if (!$auth) {
            
            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
        }

        /*--------------------------------POSITIVE-RESPONSE--------------------------------*/

        $response = ResponseJson::format($model, ''); 
        return response()->json($response, 200);
    }

    public function getAccountInfo($accountId, Request $request) {

        /*------------------------------CHECK-ID-FROM-REQUEST------------------------------*/

        $model = $this->MODEL->find($accountId);

        if (!$model) {

            $response = ResponseJson::format([], self::$MODEL_NAME_UP_FIRST . ' not found');
            return response()->json($response, 404);
        }

        /*----------------------------------AUTHORIZATION----------------------------------*/
        
        $auth = Gate::inspect('viewSingleDetails', [self::$MODEL_CLASS, $accountId])->allowed();
        
        if (!$auth) {
            
            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
        }

        $model = $model->select('name', 'surname')->where('id', $accountId)->get()->toArray()[0];

        /*--------------------------------POSITIVE-RESPONSE--------------------------------*/

        $response = ResponseJson::format($model, ''); 
        return response()->json($response, 200);
    }

    public function createAccount(Request $request){

        /*----------------------------------AUTHORIZATION----------------------------------*/


        /* $auth = Gate::inspect('create', self::$MODEL_CLASS)->allowed();

        if (!$auth) {

            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
        } */

        /*------------------------------------FUNCTION-------------------------------------*/

        $rules = [
            'username' => 'required|string|min:5|max:255|unique:accounts',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:accounts',
            'surname' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ];

        $validationMsgs = Translations::getValidations(self::$MODEL_CLASS);

        $validations = ApiFunctions::validateCreation($request, $rules, $validationMsgs);

        if (count($validations['data']) === 0) {

            $result = ResponseJson::format([], $validations['message']);
            return response()->json($result, 400);
        }

        $data = $validations['data'];

        if (count($data) === 0) {

            $result = ResponseJson::format([], $data['message']);
            return response()->json($result, 400);
        }


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
                $result = ResponseJson::format([], 'Insert unsuccess');
                return response()->json($result, 500);
            }

        } catch (\Exception $e){

            $msg = 'Error while creating new ' . self::$MODEL_NAME_LOWER;

            $result = ResponseJson::format([], $msg);
            return response()->json($result, 500);
        }

        /*-------------------------------CREATE-NEW-ACCOUNT--------------------------------*/

        $result = ResponseJson::format($lastId, self::$MODEL_NAME_UP_FIRST . ' created successfully');
        return response()->json($result, 201);
    }

    public function updateAccount($accountId, Request $request){

        /*----------------------------------AUTHORIZATION----------------------------------*/

        $auth = Gate::inspect('update', [self::$MODEL_CLASS, $accountId])->allowed();

        if (!$auth) {

            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
        }

        /*------------------------------CHECK-ID-FROM-REQUEST------------------------------*/

        $model = $this->MODEL->find($accountId);

        if (!$model) {

            $response = ResponseJson::format([], self::$MODEL_NAME_UP_FIRST . ' not found');
            return response()->json($response, 404);
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
        
        $validationMsgs = Translations::getValidations(self::$MODEL_CLASS);

        $validations = ApiFunctions::validateUpdate($request, $rules, false, $validationMsgs);

        /*-------------------------------CHECK-VALIDATION----------------------------------*/
        

        if (count($validations['data']) === 0) {

            $result = ResponseJson::format([], $validations['message']);
            return response()->json($result, 400);
        }

        $data = $validations['data'];

        if (count($data) === 0) {

            $result = ResponseJson::format([], $data['message']);
            return response()->json($result, 400);
        }

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
            $response = ResponseJson::format([], 'Update unsuccess');
            return response()->json($response, 500);
        }

        /*---------------------------------POSITIVE-RESPONSE-------------------------------*/

        $response = ResponseJson::format([], 'Update Success');
        return response()->json($response, 200);
    }

    public function deleteAccount($accountId, Request $request){

        /*------------------------------CHECK-ID-FROM-REQUEST------------------------------*/

        $model = $this->MODEL->find($accountId);

        if (!$model) {

            $response = ResponseJson::format([], self::$MODEL_NAME_UP_FIRST . ' not found');
            return response()->json($response, 404);
        }

        /*----------------------------------AUTHORIZATION----------------------------------*/

        $auth = Gate::inspect('delete', [self::$MODEL_CLASS, $accountId])->allowed();

        if (!$auth) {

            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
        }
        
        /*-------------------------------DELETE-MODEL-IN-DB--------------------------------*/

        $deleted = $model->forceDelete();

        if (!$deleted) {

            $result = ResponseJson::format([], 'Delete unsuccess');
            return response()->json($result, 500);
        }

        $result = ResponseJson::format([], 'Delete success');
        return response()->json($result, 200);
    }

    /*--------------------------------PRIVATE-FUNCTIONS--------------------------------*/

}