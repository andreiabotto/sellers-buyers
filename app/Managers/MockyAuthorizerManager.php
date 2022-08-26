<?php

namespace App\Managers;

use App\Managers\Interfaces\IAuthorizeTransactionManager;
use App\Models\Transaction;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MockyAuthorizerManager implements IAuthorizeTransactionManager
{

    public function IsTransactionAuthorized(Transaction $transaction): bool
    {
        try {
            $response = HTTP::acceptJson()->timeout(30)->get('https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6');
            $response->throw();
            $result = $response->json();
            if($result['message'] !== "Autorizado")
                throw new \Exception("Notification Not Successfull");

            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}
