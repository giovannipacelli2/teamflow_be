<?php

namespace App\Services;
use App\Models\Account;

class CommentService
{
    /**
     * Create a new class instance.
     */
    public function __construct(){}

    /**
     * @param mixed $model Eloquent instance of Comment model
     * @param 'single'|'paginated' $mode Define if Eloquent instance is paginated or not, is 'single' by default
     * @return mixed|null $model Updated Eloquent instance of Comment
    */
    public function processData($model, $mode='single'){
        
        
        if ($mode === 'single'){
            
            return $this->response($model);
        }
        if ($mode === 'paginated'){
            
            return $model->through(fn($elem) => $this->response($elem));
        }

        return null;
        
    }

    /**
     * @param mixed $model Eloquent instance of Comment model
     * @return mixed $model Updated Eloquent instance of Comment
    */
    private function response($model){
        $account = Account::find($model->account_id);
        $model->account_username = $account->username;
        return $model;
    }
}
