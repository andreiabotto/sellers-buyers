<?php

namespace App\Repository;

use App\Models\Transaction;

class TransactionRepository extends Repository
{
    public function __construct()
    {
        $this->model = new Transaction();
    }

    function GetModelPath()
    {
        return "App\\Models\\TransactionController";
    }
}
