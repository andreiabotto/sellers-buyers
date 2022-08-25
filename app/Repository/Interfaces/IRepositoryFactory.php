<?php

namespace App\Repository\Interfaces;

use App\Repository\AccountRepository;
use App\Repository\WalletRepository;

interface IRepositoryFactory
{
    public function GetAccountRepository() : AccountRepository;
    public function GetWalletRepository() : WalletRepository;
}
