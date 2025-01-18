<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\Todo;
use Illuminate\Auth\Access\Response;
use App\Translations\Translations;

class TodoPolicy
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
     * Determine whether the user can view any models.
     */
    public function viewSharedAccounts(Account $currentAccount): Response
    {
        $can = (bool) $currentAccount;
        return $this->getPermission($can);
    }

    /**
     * Determine whether the user can view any shared models.
     */
    public function viewShared(Account $currentAccount): Response
    {
        $can = (bool) $currentAccount;
        return $this->getPermission($can);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function viewSingle(Account $currentAccount, Todo $model): Response
    {
        $can = $currentAccount->isAdmin() || $currentAccount->hisTodo($model, true);

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
    public function update(Account $currentAccount, $model): Response
    {
        $can = $currentAccount->isAdmin() || $currentAccount->hisTodo($model, true);

        return $this->getPermission($can);
    }

    /**
     * Determine whether the user can share the model.
     */
    public function share(Account $currentAccount, $model): Response
    {
        $can = $currentAccount->isAdmin() || $currentAccount->hisTodo($model);

        return $this->getPermission($can);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Account $currentAccount, $model): Response
    {
        $can = $currentAccount->isAdmin() || $currentAccount->hisTodo($model);

        return $this->getPermission($can);
    }

    private function getPermission($can) : Response {
        if($can){
            return Response::allow();
        }

        return Response::denyWithStatus(403, $this->MSG['unauthorized']);
    }
}
