<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\Models\Todo;

// Custom static class
use App\Include\ApiFunctions;
use App\Include\SortFilter;
use App\Rules\accountValidation;
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
            $model = $model->paginate($limit)->toArray();

        } catch (\Exception $e) {

            $response = ResponseJson::format([], 'Error while getting the ' . self::$MODEL_NAME_LOWER . 's');

            return response()->json($response, 500);
        }

        $response = ResponseJson::format($model, '');

        return response()->json($response, 200);
    }

    public function getTodo($modelId, Request $request) {

        /*------------------------------CHECK-ID-FROM-REQUEST------------------------------*/

        $model = $this->MODEL->find($modelId);

        if (!$model) {

            $response = ResponseJson::format([], self::$MODEL_NAME_UP_FIRST . ' not found');
            return response()->json($response, 404);
        }

        /*----------------------------------AUTHORIZATION----------------------------------*/
        
        $auth = Gate::inspect('viewSingle', [self::$MODEL_CLASS, $model])->allowed();
        
        if (!$auth) {
            
            $result = ResponseJson::format([], 'Not Authorized');
            return response()->json($result, 403);
        }

        /*--------------------------------POSITIVE-RESPONSE--------------------------------*/

        $response = ResponseJson::format($model, ''); 
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
            'category' => 'nullable|string',
            'checked' => 'required|boolean',
            'accountId' => ['required', new accountValidation],
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

        dd($modelObj);


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
}
