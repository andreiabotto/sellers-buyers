<?php

namespace App\Managers\Interfaces;

use App\Models\Transaction;

interface IAuthorizeTransactionManager
{
    public function IsTransactionAuthorized(Transaction $transaction) : bool;
}
