<?php

namespace App\Managers;

use App\Managers\Interfaces\IAuthorizeTransactionManager;
use App\Models\Transaction;

class MockyAuthorizerManager implements IAuthorizeTransactionManager
{

    public function IsTransactionAuthorized(Transaction $transaction): bool
    {
        // TODO: Implement IsTransactionAuthorized() method.
    }
}
