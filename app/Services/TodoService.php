<?php

namespace App\Services;

class TodoService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private CommentService $CommentService
    ){}

    /**
     * @param mixed $model Eloquent instance of Todo model
     * @param 'single'|'paginated' $mode Define if Eloquent instance is paginated or not, is 'single' by default
     * @return mixed|null $model Updated Eloquent instance of Todo
    */
    public function processData($model, $mode='single'){

        if($mode==='single'){
            
           return $this->response($model);

        } else if($mode==='paginated'){

            return $model->through(fn($todo)=> $this->response($todo));
        }

    }

    /**
     * @param mixed $model Eloquent instance of Todo model
     * @return mixed $model Updated Eloquent instance of Todo
    */
    private function response($todo){
        $accounts = $todo->sharedWith()->get()->makeHidden(['pivot']);

        $res = [];

        foreach ($accounts as $account) {

            array_push($res, [
                'id' => $account['id'],
                'username' => $account['username'],
            ]);
        }
        $todo->sharedWith = $res;
        $todo->isShared = count($res) > 0;

        //dd($todo->comments()->get()->toArray());

        $todo->comments = $todo->comments()->get()
                ->map(fn($comment) => $this->CommentService->processData($comment));

        return $todo;
    }
}
