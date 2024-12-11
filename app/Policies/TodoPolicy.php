<?php

namespace App\Policies;

use App\Models\Account;

class TodoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Account $currentAccount): bool
    {

        return $currentAccount->isAdmin();
    }

    /**
     * Determine whether the user can view any shared models.
     */
    public function viewShared(Account $currentAccount): bool
    {

        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function viewSingle(Account $currentAccount, $model): bool
    {
        $modelId = $model->get()->toArray()[0]['id'];
        $accountId = $model->get()->toArray()[0]['account_id'];
        
        $shared = $model->find($modelId)->sharedWith()->wherePivot('todo_id', $modelId);

        $hisElem = $currentAccount->id == $accountId;
        $isAdmin = $currentAccount->isAdmin();
        $isShared = count($shared->get()->toArray()) > 0;

        return ($isAdmin || $hisElem | $isShared);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Account $currentAccount): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Account $currentAccount, $model): bool
    {
        $modelId = $model->get()->toArray()[0]['id'];
        $accountId = $model->get()->toArray()[0]['account_id'];
        
        $shared = $model->find($modelId)->sharedWith()->wherePivot('todo_id', $modelId);

        $hisElem = $currentAccount->id == $accountId;
        $isAdmin = $currentAccount->isAdmin();
        $isShared = count($shared->get()->toArray()) > 0;

        return ($isAdmin || $hisElem | $isShared);
    }

    /**
     * Determine whether the user can share the model.
     */
    public function share(Account $currentAccount, $model): bool
    {
        $accountId = $model->get()->toArray()[0]['account_id'];
        
        $hisElem = $currentAccount->id == $accountId;
        $isAdmin = $currentAccount->isAdmin();

        return ($isAdmin || $hisElem);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Account $currentAccount, $model): bool
    {
        $accountId = $model->get()->toArray()[0]['account_id'];
        
        $hisElem = $currentAccount->id == $accountId;
        $isAdmin = $currentAccount->isAdmin();

        return ($isAdmin || $hisElem);
    }
}
