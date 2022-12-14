<?php

namespace App\Repository;

use App\Models\Account;
use App\Repository\Interfaces\IRepository;
use Illuminate\Database\Eloquent\Model;

class AccountRepository extends Repository
{

    public function __construct()
    {
        $this->model = new Account();
    }

    public function GetModelPath() : string
    {
        return "App\\Models\\Account";
    }
}
