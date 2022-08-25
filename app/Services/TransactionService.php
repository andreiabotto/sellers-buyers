<?php

namespace App\Services;

use App\Managers\Interfaces\IAuthorizeTransactionManager;
use App\Models\Transaction;
use App\Repository\Interfaces\IRepositoryFactory;

class TransactionService
{
    private IAuthorizeTransactionManager $transactionManager;
    private $repositoryFactory;

    public function __construct(IAuthorizeTransactionManager $transactionManager, IRepositoryFactory $repositoryFactory)
    {
        $this->transactionManager = $transactionManager;
        $this->repositoryFactory = $repositoryFactory;
    }

    public function TransferMoney($accountIdSender, $accountIdReceiver, $value)
    {
        try {
            if($value <= 0) {
                throw new \Exception("Transaction with Zero or negative value not allowed", 400);
            }

            $accountRepo = $this->repositoryFactory->GetAccountRepository();
            $sender = $accountRepo->Find($accountIdSender);

            if($sender == null)
                throw new \Exception("Invalid Sender", 400);

            $receiver = $accountRepo->Find($accountIdReceiver);

            if($receiver == null)
                throw new \Exception("Invalid Receiver", 400);


            $transaction = new Transaction();
            $transaction->FromWallet()->associate($sender->Wallet);
            $transaction->ToWallet()->associate($receiver->Wallet);
            $transaction->value = $value;

            $isAuthorized = $this->transactionManager->IsTransactionAuthorized($transaction);

        } catch (\Exception $e) {

        }
    }
}
