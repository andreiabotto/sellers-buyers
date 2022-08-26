<?php

namespace App\Repository;

use App\Models\Wallet;

class WalletRepository extends Repository
{
    public function __construct()
    {
        $this->model = new Wallet();
    }

    function GetModelPath()
    {
        return "App\\Models\\Wallet";
    }
}
