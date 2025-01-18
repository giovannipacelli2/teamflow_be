<?php

namespace App\Policies;

use App\Models\Account;
use Illuminate\Auth\Access\Response;
use App\Translations\Translations;

class AccountPolicy
{

    private $MSG;

    public function __construct() {
        $this->MSG = Translations::getMessages('generic');
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Account $currentAccount): Response
    {

        $can = $currentAccount->isAdmin();
        return $this->getPermission($can);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function viewSingle(Account $currentAccount, $accountId): Response
    {
        $hisAccount = $currentAccount->id == $accountId;
        $isAdmin = $currentAccount->isAdmin();

        $can = $isAdmin || $hisAccount;

        return $this->getPermission($can);
    }

        /**
     * Determine whether the user can view any accounts usernames.
     */
    public function viewAnyUsernames(Account $currentAccount): Response
    {
        $can = (bool) $currentAccount;
        return $this->getPermission($can);
    }

    public function viewSingleDetails(Account $currentAccount, $accountId): Response
    {
        $can = (bool) $currentAccount;
        return $this->getPermission($can);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Account $currentAccount): Response
    {
        $can = (bool) $currentAccount;
        return $this->getPermission($can);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Account $currentAccount, $accountId): Response
    {
        $hisAccount = $currentAccount->id == $accountId;
        $isAdmin = $currentAccount->isAdmin();

        $can = $isAdmin || $hisAccount;
        return $this->getPermission($can);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Account $currentAccount, $accountId): Response
    {
        $hisAccount = $currentAccount->id == $accountId;
        $isAdmin = $currentAccount->isAdmin();

        // admin can't delete his self
        if ($isAdmin && $hisAccount){
            $this->getPermission(false);
        }

        $can = $isAdmin || $hisAccount;
        return $this->getPermission($can);
    }

    private function getPermission($can) : Response {
        if($can){
            return Response::allow();
        }

        return Response::denyWithStatus(403, $this->MSG['unauthorized']);
    }
}