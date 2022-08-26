<?php

namespace App\Managers;

use App\Managers\Interfaces\ISenderManager;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SenderSmsManager implements ISenderManager
{

    public function SendMessage($address, $message) : bool
    {
        try {
            $response = HTTP::acceptJson()->timeout(30)->get('http://o4d9z.mocklab.io/notify');
            $response->throw();
            $result =$response->json();
            if($result['message'] !== "Success")
                throw new \Exception("Notification Not Successfull");

            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}
