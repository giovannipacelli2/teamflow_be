<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\Todo;
use App\Models\Comment;
use Illuminate\Auth\Access\Response;
use App\Translations\Translations;

class CommentPolicy
{
    private $MSG;

    public function __construct() {
        $this->MSG = Translations::getMessages('generic');
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Account $account) : Response
    {
        $can = $account->isAdmin();

        return $this->getPermission($can);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function viewSingle(Account $currentAccount, Comment $model): Response
    {
        $modelTodo = Todo::find($model->todo_id);
        $can = $currentAccount->isAdmin() || $currentAccount->hisTodo($modelTodo, true);

        return $this->getPermission($can);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Account $currentAccount, Todo $modelTodo): Response
    {
        $can = $currentAccount->isAdmin() || $currentAccount->hisTodo($modelTodo, true);

        return $this->getPermission($can);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Account $currentAccount, Comment $model): Response
    {
        $hisComment = $model->account_id === $currentAccount->id;
        $can = $currentAccount->isAdmin() || $hisComment;

        return $this->getPermission($can);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Account $currentAccount, Comment $model): Response
    {
        $modelTodo = Todo::find($model->todo_id);
        $can = $currentAccount->isAdmin() || $currentAccount->hisTodo($modelTodo, true);

        return $this->getPermission($can);
    }

    private function getPermission($can) : Response {
        if($can){
            return Response::allow();
        }

        return Response::denyWithStatus(403, $this->MSG['unauthorized']);
    }

}
