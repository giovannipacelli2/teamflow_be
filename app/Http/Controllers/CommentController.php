<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Models\Todo;
use App\Models\Comment;

// Custom static class
use App\Include\ApiFunctions;
use App\Include\SortFilter;
use App\Rules\accountValidation;
use App\Rules\TodoValidation;
use App\Translations\Translations;
use App\Services\CommentService;

class CommentController extends Controller
{
    private static $MODEL_CLASS = Comment::class;
    private $validationMsgs;
    private $genericMsgs;
    private $MODEL;

    public function __construct(
        private CommentService $CommentService 
    )
    {
        $this->MODEL = new self::$MODEL_CLASS();
        $this->validationMsgs = Translations::getValidations(self::$MODEL_CLASS);
        $this->genericMsgs = Translations::getMessages('generic');

        $this->CommentService = $CommentService;
    }

    public function getAllTodoComments(Request $request, $todoId) {

        /*------------------------------CHECK-ID-FROM-REQUEST------------------------------*/

        $todoModel = Todo::find($todoId);

        if (!$todoModel) {

            return ResponseJson::response([], 404, $this->genericMsgs['not_found']);
        }

        /*----------------------------------AUTHORIZATION----------------------------------*/


        $auth = Gate::inspect('viewSingle', [Todo::class, $todoModel]);

        if (!$auth->allowed()) {

            return ResponseJson::response([], $auth->status(), $auth->message());
        }

        /*--------------------------------GET-QUERY-STRING---------------------------------*/

        $limit = $request->query('limit') ? (int) $request->query('limit') : 10;

        /*-----------------------------------GET-COMMENTS----------------------------------*/

        $model = $this->MODEL->where('todo_id', $todoId);

        /*--------------------------------FILTERING/SORTING--------------------------------*/

        SortFilter::sortFilter($request, $model);

        /*---------------------------------PAGINATE-RESULT---------------------------------*/
        
        try {
    
            // paginate data
            $model = $model->paginate($limit);
            $model = $this->CommentService->processData($model, 'paginated');

        } catch (\Exception $e) {

            return ResponseJson::response([], 500, $this->genericMsgs['query_fail']);
        }

        $response = ResponseJson::format($model, '');

        return response()->json($response, 200);
    }

    public function getComment(Request $request, $modelId) {

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

        $model = $this->CommentService->processData($model);

        return ResponseJson::response($model);
    }

    public function createComment(Request $request, $todoId){

        /*------------------------------------FUNCTION-------------------------------------*/

        $request['todoId'] = $todoId;

        $rules = [
            'content'=>'required|string',
            'todoId'=>['required', 'string', new TodoValidation],
        ];

        $data = ApiFunctions::simpleValidate($request, $rules, $this->validationMsgs);

        /*----------------------------------AUTHORIZATION----------------------------------*/

        $todoModel = Todo::find($todoId);

        $auth = Gate::inspect('create', $todoModel);

        if (!$auth->allowed()) {

            return ResponseJson::response([], $auth->status(), $auth->message());
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
                return ResponseJson::response([], 500, $this->genericMsgs['post_unsucc']);
            }

        } catch (\Exception $e){

            return ResponseJson::response([], 500, $this->genericMsgs['query_fail']);

        }

        /*--------------------------------CREATE-NEW-MODEL---------------------------------*/

        return ResponseJson::response($lastId, 201, $this->genericMsgs['post_succ']);
        
    }

    public function updateComment($commentId, Request $request){

        /*-----------------------------------FIND-MODEL------------------------------------*/

        $checkModel = $this->MODEL->find($commentId);

        if (!$checkModel) {
        
            return ResponseJson::response([], 404, $this->genericMsgs['not_found']);
        }

        /*----------------------------------AUTHORIZATION----------------------------------*/
        
        $auth = Gate::inspect('update', [self::$MODEL_CLASS, $checkModel]);

        if (!$auth->allowed()) {

            return ResponseJson::response([], $auth->status(), $auth->message());
        }

        /*---------------------------------DATA-VALIDATION---------------------------------*/

        // Filter the inserted data

        $rules = [
            'content' => 'required|string',
        ];

        $data = ApiFunctions::simpleValidate($request, $rules, $this->validationMsgs);

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

    public function deleteComment($commentId){

        /*-----------------------------CHECK-IF-PATIENT-EXISTS-----------------------------*/

        $checkModel = $this->MODEL::find($commentId);
        
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
}
