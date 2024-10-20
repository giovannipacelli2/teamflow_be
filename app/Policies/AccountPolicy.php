<?php

namespace App\Policies;

use App\Models\Account;
use Illuminate\Auth\Access\Response;

class AccountPolicy
{
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
    public function viewSingle(Account $currentAccount, $accountId): bool
    {
        $hisAccount = $currentAccount->id == $accountId;
        $isAdmin = $currentAccount->isAdmin();

        return ($isAdmin || $hisAccount);
    }

    public function viewSingleDetails(Account $currentAccount, $accountId): bool
    {
       return true;
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
    public function update(Account $currentAccount, $accountId): bool
    {
        $hisAccount = $currentAccount->id == $accountId;
        $isAdmin = $currentAccount->isAdmin();

        return ($isAdmin || $hisAccount);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Account $currentAccount, $accountId): bool
    {
        $hisAccount = $currentAccount->id == $accountId;
        $isAdmin = $currentAccount->isAdmin();

        // admin can't delete his self
        if ($isAdmin && $hisAccount){
            return false;
        }

        return ($isAdmin || $hisAccount);
    }
}