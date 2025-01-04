<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Models\Todo;
use App\Models\Account;

// Custom static class
use App\Include\ApiFunctions;
use App\Include\SortFilter;
use App\Rules\accountValidation;
use App\Rules\TodoValidation;
use App\Translations\Translations;


class TodoController extends Controller
{
    private static $MODEL_NAME_UP_FIRST = 'Todo';
    private static $MODEL_NAME_LOWER = 'todo';
    private static $MODEL_CLASS = Todo::class;
    private $MODEL;

    public function __construct()
    {
        $this->MODEL = new self::$MODEL_CLASS();
    }

    public function getAllTodos(Request $request) {

        /*----------------------------------AUTHORIZATION----------------------------------*/

        $viewAll = Gate::inspect('viewAny', self::$MODEL_CLASS)->allowed();

        $currentAccount = Auth::user();

        if (!$currentAccount) {

            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
        }

        /*--------------------------------GET-QUERY-STRING---------------------------------*/

        $limit = $request->query('limit') ? (int) $request->query('limit') : 5;

        /*-----------------------ELEMENTS-FROM-ACCOUNT-PERMISSIONS-------------------------*/

        $model = null;

        if ($viewAll) {

            $model = $this->MODEL->select('*');
        } else {
            
            $model = $this->MODEL->where('account_id', $currentAccount->id);
        }


        /*--------------------------------FILTERING/SORTING--------------------------------*/


        SortFilter::sortFilter($request, $model);

        /*---------------------------------PAGINATE-RESULT---------------------------------*/
        
        try {
    
            // paginate data
            $model = $model->paginate($limit);

            $model = $this->processData($model, 'paginate');

        } catch (\Exception $e) {

            $response = ResponseJson::format([], 'Error while getting the ' . self::$MODEL_NAME_LOWER . 's');

            return response()->json($response, 500);
        }

        $response = ResponseJson::format($model, '');

        return response()->json($response, 200);
    }

    public function getAllTodoAccounts(Request $request, $modelId) {

        /*----------------------------------AUTHORIZATION----------------------------------*/

        $auth = Gate::inspect('viewSharedAccounts', self::$MODEL_CLASS)->allowed();

        if (!$auth) {

            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
        }

        /*---------------------------------DATA-VALIDATION---------------------------------*/

        // Filter the inserted data

        $req = [
            'todoId' => $modelId,
        ];
        $rules = [
            'todoId' => ['required', 'string', new TodoValidation],
        ];

        $validationMsgs = Translations::getValidations(self::$MODEL_CLASS);
        $validator = validator($req, $rules, $validationMsgs);

        if ($validator->fails()) {
            return ResponseJson::response([], 400, $validator->errors());
        }

        /*------------------------------------GET-MODEL------------------------------------*/

        $model = $this->MODEL->find($modelId);

        /*---------------------------------PAGINATE-RESULT---------------------------------*/
        
        try {
    
            // get todo accounts
            $accounts = $model->sharedWith()->get()->select(['id', 'username']);

        } catch (\Exception $e) {

            $response = ResponseJson::format([], 'Error while getting the ' . self::$MODEL_NAME_LOWER . 's');

            return response()->json($response, 500);
        }

        $response = ResponseJson::format($accounts, '');

        return response()->json($response, 200);
    }

    public function getAllSharedTodos(Request $request) {

        /*----------------------------------AUTHORIZATION----------------------------------*/

        $viewAll = Gate::inspect('viewShared', self::$MODEL_CLASS)->allowed();

        $currentAccount = Auth::user();

        if (!$currentAccount && !$viewAll) {

            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
        }

        /*--------------------------------GET-QUERY-STRING---------------------------------*/

        $limit = $request->query('limit') ? (int) $request->query('limit') : 5;

        /*-----------------------ELEMENTS-FROM-ACCOUNT-PERMISSIONS-------------------------*/

        $currentAccount = Account::find(Auth::user()->id);

        $model = $currentAccount->sharedWithMe();

        /*--------------------------------FILTERING/SORTING--------------------------------*/


        SortFilter::sortFilter($request, $model);

        /*---------------------------------PAGINATE-RESULT---------------------------------*/
        
        try {
    
            // paginate data
            $model = $model->paginate($limit);
            $model = $this->processData($model, 'paginate');

        } catch (\Exception $e) {

            $response = ResponseJson::format([], 'Error while getting the ' . self::$MODEL_NAME_LOWER . 's');

            return response()->json($response, 500);
        }

        $response = ResponseJson::format($model, '');

        return response()->json($response, 200);
    }

    public function getTodo($modelId, Request $request) {

        /*------------------------------CHECK-ID-FROM-REQUEST------------------------------*/

        $checkModel = $this->MODEL->find($modelId);

        if (!$checkModel) {

            $response = ResponseJson::format([], self::$MODEL_NAME_UP_FIRST . ' not found');
            return response()->json($response, 404);
        }

        $model = $this->MODEL->where('id', $modelId);

        /*----------------------------------AUTHORIZATION----------------------------------*/
        
        $auth = Gate::inspect('viewSingle', [self::$MODEL_CLASS, $model])->allowed();
        
        if (!$auth) {
            
            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
        }

        /*--------------------------------POSITIVE-RESPONSE--------------------------------*/

        $res = $this->processData($checkModel);

        $response = ResponseJson::format($res, ''); 
        return response()->json($response, 200);
    }

    public function createTodo(Request $request){

        /*----------------------------------AUTHORIZATION----------------------------------*/


        $auth = Gate::inspect('create', self::$MODEL_CLASS)->allowed();

        if (!$auth) {

            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
        }

        /*------------------------------------FUNCTION-------------------------------------*/

        $rules = [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'note' => 'nullable|string',
            'category' => 'nullable|string',
            'checked' => 'nullable|boolean',
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


        /*--------------------------------CREATE-NEW-MODEL---------------------------------*/

        $modelObj = ApiFunctions::arrCamelToSnake($data);

        // add account id
        $currentAccountId = Auth::user()->id;
        $modelObj['account_id'] = $currentAccountId;

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

    public function updateTodo($todoId, Request $request){

        /*-----------------------------------FIND-MODEL------------------------------------*/

        $checkModel = $this->MODEL->find($todoId);

        if (!$checkModel) {
        
            $result = ResponseJson::format([], self::$MODEL_NAME_UP_FIRST . ' not found');
            return response()->json($result, 404);
        }

        $model = $this->MODEL->where('id', $todoId);

        /*----------------------------------AUTHORIZATION----------------------------------*/
        
        $auth = Gate::inspect('update', [self::$MODEL_CLASS, $model])->allowed();

        if (!$auth) {

            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
        }

        /*---------------------------------DATA-VALIDATION---------------------------------*/

        // Filter the inserted data

        $rules = [
            'title' => 'string',
            'description' => 'nullable|string',
            'note' => 'nullable|string',
            'category' => 'nullable|string',
            'checked' => 'nullable|boolean',
        ];

        $validationMsgs = Translations::getValidations(self::$MODEL_CLASS);

        $validations = ApiFunctions::validateUpdate($request, $rules, true, $validationMsgs);

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

        if (array_key_exists('description', $data) && !$data['description']){
            $data['description'] = '';
        }
        if (array_key_exists('note', $data) && !$data['note']){
            $data['note'] = '';
        }

        /*----------------------------CREATE-ELOQUENT-PATIENT-MODEL------------------------*/

        $modelObj = ApiFunctions::arrCamelToSnake($data);

        /*---------------------------------STORE-DATA-IN-DB--------------------------------*/

        try{
            //Update account
            $model->update($modelObj);

        } catch (\Exception $e) {
            $response = ResponseJson::format([], 'Update unsuccess');
            return response()->json($response, 500);
        }
        $response = ResponseJson::format([], 'Update success');
        return response()->json($response, 200);
    }

    public function shareTodo($todoId, Request $request){

        /*-----------------------------------FIND-MODEL------------------------------------*/

        $checkModel = $this->MODEL->find($todoId);

        if (!$checkModel) {
        
            $result = ResponseJson::format([], self::$MODEL_NAME_UP_FIRST . ' not found');
            return response()->json($result, 404);
        }

        $model = $this->MODEL->where('id', $todoId);

        /*----------------------------------AUTHORIZATION----------------------------------*/
        
        $auth = Gate::inspect('share', [self::$MODEL_CLASS, $model])->allowed();

        if (!$auth) {

            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
        }

        /*---------------------------------DATA-VALIDATION---------------------------------*/

        // Filter the inserted data

        $rules = [
            'accounts' => 'nullable|array',
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

        /*-----------------------------------CHECK-ACCOUNTS--------------------------------*/
        
        $accountRules = [];
        $accountIds = [];

        foreach($data['accounts'] as $i=>$account){

            $field = 'account_' . $i;

            $accountIds = [
                ...$accountIds,
                $field => $account
            ];

           $accountRules = [
                ...$accountRules,
                $field => [new accountValidation]
           ];

        }

        $validator = validator($accountIds, $accountRules);

        if ($validator->fails()) {

            $errors = $validator->errors();

            $result = ResponseJson::format([], $errors);
            return response()->json($result, 400);
        }

        /*---------------------------------STORE-DATA-IN-DB--------------------------------*/

        try{
            //update pivot
            $this->MODEL->find($todoId)->sharedWith()->sync($data['accounts']);

        } catch (\Exception $e) {
            $response = ResponseJson::format([], 'Update unsuccess');
            return response()->json($response, 500);
        }
        $response = ResponseJson::format([], 'Update success');
        return response()->json($response, 200);
    }

    public function deleteTodo($todoId){

        /*-----------------------------CHECK-IF-PATIENT-EXISTS-----------------------------*/

        $checkModel = $this->MODEL::find($todoId);
        
        if (!$checkModel) {
            
            $response = ResponseJson::format([], self::$MODEL_NAME_UP_FIRST . ' not found');
            return response()->json($response, 404);
        }

        $model = $checkModel->where('id', $todoId);

        /*----------------------------------AUTHORIZATION----------------------------------*/

        $auth = Gate::inspect('delete', [self::$MODEL_CLASS, $model])->allowed();

        if (!$auth) {

            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
        }    

        /*-------------------------------DELETE-CHECK-IN-DB--------------------------------*/

        $delete = $model->forceDelete();

        if (!$delete) {

            $result = ResponseJson::format([], 'Delete unsuccess');
            return response()->json($result, 500);
        }

        $result = ResponseJson::format([], 'Delete success');
        return response()->json($result, 200);
    }

    /*----------------------------------------------------PRIVATE-FUNCTIONS----------------------------------------------------*/

    private function processData($model, $mode='single'){

        if($mode==='single'){

            $accounts = $model->sharedWith()->get()->makeHidden(['pivot']);

            $res = [];

            foreach($accounts as $account){

                array_push($res, [
                    'id'=>$account['id'],
                    'username'=>$account['username'],
                ]);
            }

            $model->sharedWith = $res;
            $model->isShared = count($res) > 0;
            
           return $model;

        } else if($mode==='paginate'){

            return $model->through(function($todo){
    
                $accounts = $todo->sharedWith()->get()->makeHidden(['pivot']);

                $res = [];

                foreach($accounts as $account){

                    array_push($res, [
                        'id'=>$account['id'],
                        'username'=>$account['username'],
                    ]);
                }
                $todo->sharedWith = $res;
                $todo->isShared = count($res) > 0;
                
                return $todo;
            });
        }

    }
}
