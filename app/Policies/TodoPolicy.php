<?php

namespace App\Policies;

use App\Models\Account;

class TodoPolicy
{
    /**
     * Create a new policy instance.
     */
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Account $currentAccount): bool
    {

        return $currentAccount->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function viewSingle(Account $currentAccount, $model): bool
    {
        $accountId = '';

        if ($model->account()){
            $accountId = $model->account()->get()->toArray()[0]['id'];
        }

        $hisElem = $currentAccount->id == $accountId;
        $isAdmin = $currentAccount->isAdmin();

        return ($isAdmin || $hisElem);
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
        $accountId = '';

        if ($model->account()){
            $accountId = $model->account()->get()->toArray()[0]['id'];
        }

        $hisElem = $currentAccount->id == $accountId;
        $isAdmin = $currentAccount->isAdmin();

        return ($isAdmin || $hisElem);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Account $currentAccount, $model): bool
    {
        $accountId = '';

        if ($model->account()){
            $accountId = $model->account()->get()->toArray()[0]['id'];
        }

        $hisElem = $currentAccount->id == $accountId;
        $isAdmin = $currentAccount->isAdmin();

        return ($isAdmin || $hisElem);
    }
}
