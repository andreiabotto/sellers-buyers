<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountRequest;
use App\Services\AccountService;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    private $service;
    public function __construct(AccountService $service)
    {
        $this->service = $service;
    }

    public function imOk() {
        return 'OK';
    }

    public function createUser(CreateAccountRequest $request)
    {
        return $this->service->CreateUserAccount(
            $request->get('cpf'),
            $request->get('email'),
            $request->get('first_name'),
            $request->get('last_name'),
            $request->get('password'),
            $request->get('balance')
        );
    }

    public function createSeller(CreateAccountRequest $request)
    {
        return $this->service->CreateSellerAccount(
            $request->get('cpf'),
            $request->get('email'),
            $request->get('first_name'),
            $request->get('last_name'),
            $request->get('password'),
            $request->get('balance')
        );
    }
}
