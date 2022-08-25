<?php

namespace App\Services;

use App\Managers\Interfaces\IAuthorizeTransactionManager;
use App\Repository\Interfaces\IRepositoryFactory;

class AccountService
{
    private $authorizeManager;
    private $repositoryFactory;

    public function __construct(IAuthorizeTransactionManager $authorizeTransactionManager, IRepositoryFactory $repositoryFactory)
    {
        $this->authorizeManager = $authorizeTransactionManager;
        $this->repositoryFactory = $repositoryFactory;
    }

    public function CreateAccount($cpf, $email, $firstName, $lastName, $password)
    {

    }
}
