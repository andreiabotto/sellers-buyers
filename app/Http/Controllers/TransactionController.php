<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private $service;

    public function __construct(TransactionService $service)
    {
        $this->service = $service;
    }

    public function imOk() {
        return 'OK';
    }

    public function transferMoney(TransactionRequest $request)
    {
        return $this->service->TransferMoney($request->get('sender_id'), $request->get('receiver_id'), $request->get('value'));
    }
}
