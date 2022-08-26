<?php

namespace App\Services;

use App\Managers\Interfaces\IAuthorizeTransactionManager;
use App\Models\Account;
use App\Models\Wallet;
use App\Repository\Interfaces\IRepositoryFactory;
use Illuminate\Support\Facades\Hash;

class AccountService
{
    private $repositoryFactory;

    public function __construct(IRepositoryFactory $repositoryFactory)
    {
        $this->repositoryFactory = $repositoryFactory;
    }

    public function CreateUserAccount($cpf, $email, $firstName, $lastName, $password, $initialBalance = 0)
    {
        return $this->CreateBaseAccount($cpf, $email, $firstName, $lastName, $password, $initialBalance, false);
    }

    public function CreateSellerAccount($cpf, $email, $firstName, $lastName, $password, $initialBalance = 0)
    {
        return $this->CreateBaseAccount($cpf, $email, $firstName, $lastName, $password, $initialBalance, true);
    }

    private function CreateBaseAccount($cpf, $email, $firstname, $lastName, $password, $initialBalance = 0, $isSeller = false)
    {
        $accountRepo = $this->repositoryFactory->GetAccountRepository();
        if($accountRepo->Exists('cpf', $cpf) || $accountRepo->Exists('email', $email))
            throw new \Exception('CPF ou email already registered', 400);

        $newAccount = new Account();
        $newAccount->cpf = $cpf;
        $newAccount->email = $email;
        $newAccount->first_name = $firstname;
        $newAccount->last_name = $lastName;
        $newAccount->password =  Hash::make($password);
        $newAccount->is_seller = $isSeller;
        $accountRepo->Create($newAccount);
        $accountRepo->Commit();

        $wallet = new Wallet();
        $wallet->balance = $initialBalance;
        $wallet->allow_receive = true;
        $wallet->allow_send = !$isSeller;
        $wallet->Account()->associate($newAccount);

        $walletRepo = $this->repositoryFactory->GetWalletRepository();
        $walletRepo->Create($wallet);
        $walletRepo->Commit();

        $newAccount->Wallet()->associate($wallet);
        $accountRepo->Update($newAccount->id, $newAccount);
        $accountRepo->Commit();

        return true;
    }
}
