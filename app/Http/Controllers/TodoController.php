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

use App\Services\TodoService;

class TodoController extends Controller
{
    private static $MODEL_NAME_UP_FIRST = 'Todo';
    private static $MODEL_NAME_LOWER = 'todo';
    private static $MODEL_CLASS = Todo::class;
    private $validationMsgs;
    private $genericMsgs;
    private $MODEL;

    public function __construct(
        private TodoService $TodoService
    )
    {
        $this->MODEL = new self::$MODEL_CLASS();
        $this->validationMsgs = Translations::getValidations(self::$MODEL_CLASS);
        $this->genericMsgs = Translations::getMessages('generic');
    }

    public function getAllTodos(Request $request) {

        /*----------------------------------AUTHORIZATION----------------------------------*/

        $viewAll = Gate::inspect('viewAny', self::$MODEL_CLASS)->allowed();

        /*--------------------------------GET-QUERY-STRING---------------------------------*/

        $limit = $request->query('limit') ? (int) $request->query('limit') : 5;

        /*-----------------------ELEMENTS-FROM-ACCOUNT-PERMISSIONS-------------------------*/

        $model = null;
        $currentAccount = Auth::user();

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

            $model = $this->TodoService->processData($model, 'paginated');

        } catch (\Exception $e) {

            return ResponseJson::response([], 500, $this->genericMsgs['query_fail']);
        }

        $response = ResponseJson::format($model, '');

        return response()->json($response, 200);
    }

    public function getAllTodoAccounts(Request $request, $modelId) {

        /*----------------------------------AUTHORIZATION----------------------------------*/

        $auth = Gate::inspect('viewSharedAccounts', self::$MODEL_CLASS);

        if (!$auth->allowed()) {

            return ResponseJson::response([], $auth->status(), $auth->message());
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

            return ResponseJson::response([], 500, $this->genericMsgs['query_fail']);
        }

        return ResponseJson::response($accounts);
    }

    public function getAllSharedTodos(Request $request) {

        /*----------------------------------AUTHORIZATION----------------------------------*/

        $auth = Gate::inspect('viewShared', self::$MODEL_CLASS);

        if (!$auth->allowed()) {

            return ResponseJson::response([], $auth->status(), $auth->message());
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
            $model = $this->TodoService->processData($model, 'paginated');

        } catch (\Exception $e) {

            return ResponseJson::response([], 500, $this->genericMsgs['query_fail']);
        }

        return ResponseJson::response($model);
    }

    public function getTodo($modelId, Request $request) {

        /*------------------------------CHECK-ID-FROM-REQUEST------------------------------*/

        $model = $this->MODEL->find($modelId);

        if (!$model) {

            return ResponseJson::response([], 404, $this->genericMsgs['not_found']);
        }

        /*----------------------------------AUTHORIZATION----------------------------------*/
        
        $auth = Gate::inspect('viewSingle', [self::$MODEL_CLASS, $model]);
        
        if (!$auth->allowed()) {

            return ResponseJson::response([], $auth->status(), $auth->message());
        }


        /*--------------------------------POSITIVE-RESPONSE--------------------------------*/

        $res = $this->TodoService->processData($model);

        return ResponseJson::response($res);
    }

    public function createTodo(Request $request){

        /*----------------------------------AUTHORIZATION----------------------------------*/


        $auth = Gate::inspect('create', self::$MODEL_CLASS);

        if (!$auth->allowed()) {

            return ResponseJson::response([], $auth->status(), $auth->message());
        }

        /*------------------------------------FUNCTION-------------------------------------*/

        $rules = [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'note' => 'nullable|string',
            'category' => 'nullable|string',
            'checked' => 'nullable|boolean',
        ];

        $data = ApiFunctions::simpleValidate($request, $rules, $this->validationMsgs);

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
                return ResponseJson::response($lastId, 201, $this->genericMsgs['post_succ']);
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

        /*----------------------------------AUTHORIZATION----------------------------------*/
        
        $auth = Gate::inspect('update', [self::$MODEL_CLASS, $checkModel]);

        if (!$auth->allowed()) {

            return ResponseJson::response([], $auth->status(), $auth->message());
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

        $data = ApiFunctions::simpleValidate($request, $rules, $this->validationMsgs);

        /*-------------------------------CHECK-VALIDATION----------------------------------*/

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
            $checkModel->update($modelObj);

        } catch (\Exception $e) {
            return ResponseJson::response([], 500, $this->genericMsgs['put_unsucc']);
        }

        return ResponseJson::response([], 200, $this->genericMsgs['put_succ']);
    }

    public function shareTodo($todoId, Request $request){

        /*-----------------------------------FIND-MODEL------------------------------------*/

        $checkModel = $this->MODEL->find($todoId);

        if (!$checkModel) {
        
            return ResponseJson::response([], 404, $this->genericMsgs['not_found']);
        }

        /*----------------------------------AUTHORIZATION----------------------------------*/
        
        $auth = Gate::inspect('share', [self::$MODEL_CLASS, $checkModel]);

        if (!$auth->allowed()) {

            return ResponseJson::response([], $auth->status(), $auth->message());
        }

        /*---------------------------------DATA-VALIDATION---------------------------------*/

        // Filter the inserted data

        $rules = [
            'accounts' => 'nullable|array',
        ];

        $data = ApiFunctions::simpleValidate($request, $rules, $this->validationMsgs);

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
            return ResponseJson::response([], 400, $validator->errors());
        }

        /*---------------------------------STORE-DATA-IN-DB--------------------------------*/

        try{
            //update pivot
            $this->MODEL->find($todoId)->sharedWith()->sync($data['accounts']);

        } catch (\Exception $e) {
            return ResponseJson::response([], 500, $this->genericMsgs['put_unsucc']);
        }
        return ResponseJson::response([], 200, $this->genericMsgs['put_succ']);
    }

    public function deleteTodo($todoId){

        /*-----------------------------CHECK-IF-PATIENT-EXISTS-----------------------------*/

        $checkModel = $this->MODEL::find($todoId);
        
        if (!$checkModel) {
            
            return ResponseJson::response([], 404, $this->genericMsgs['not_found']);
        }

        /*----------------------------------AUTHORIZATION----------------------------------*/

        $auth = Gate::inspect('delete', [self::$MODEL_CLASS, $checkModel]);

        if (!$auth->allowed()) {

            return ResponseJson::response([], $auth->status(), $auth->message());
        }

        /*-------------------------------DELETE-CHECK-IN-DB--------------------------------*/

        $delete = $checkModel->forceDelete();

        if (!$delete) {
            return ResponseJson::response([], 500, $this->genericMsgs['del_unsucc']);
        }

        return ResponseJson::response([], 200, $this->genericMsgs['del_succ']);
    }

    /*----------------------------------------------------PRIVATE-FUNCTIONS----------------------------------------------------*/

    
}
