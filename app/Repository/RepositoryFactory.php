<?php

namespace App\Repository;

use App\Repository\Interfaces\IRepositoryFactory;

class RepositoryFactory implements IRepositoryFactory
{

    public function GetAccountRepository(): AccountRepository
    {
        return new AccountRepository();
    }

    public function GetWalletRepository(): WalletRepository
    {
        return new WalletRepository();
    }

    public function GetTransactionRepository(): TransactionRepository
    {
       return new TransactionRepository();
    }
}
