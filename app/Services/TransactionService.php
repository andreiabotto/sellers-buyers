<?php

namespace App\Services;

use App\Events\TransactionError;
use App\Events\TransactionSuccess;
use App\Managers\Interfaces\IAuthorizeTransactionManager;
use App\Models\Transaction;
use App\Repository\Interfaces\IRepositoryFactory;
use Illuminate\Support\Facades\Log;

class TransactionService
{
    private IAuthorizeTransactionManager $transactionManager;
    private $repositoryFactory;

    public function __construct(IAuthorizeTransactionManager $transactionManager, IRepositoryFactory $repositoryFactory)
    {
        $this->transactionManager = $transactionManager;
        $this->repositoryFactory = $repositoryFactory;
    }

    /**
     * @throws \Exception
     */
    public function TransferMoney($accountIdSender, $accountIdReceiver, $value)
    {
        try {
            if($value <= 0) {
                throw new \Exception("TransactionController with Zero or negative value is not allowed", 400);
            }

            if($accountIdSender == $accountIdReceiver)
                throw new \Exception("Sender and Receiver cannot be the same", 400);

            $accountRepo = $this->repositoryFactory->GetAccountRepository();
            $sender = $accountRepo->Find($accountIdSender);

            if($sender == null)
                throw new \Exception("Invalid Sender", 400);

            $receiver = $accountRepo->Find($accountIdReceiver);

            if($receiver == null)
                throw new \Exception("Invalid Receiver", 400);

            if($sender->Wallet == null)
                throw new \Exception("Sender does not have Wallet associated", 400);

            if($receiver->Wallet == null)
                throw new \Exception("Receiver does not have Wallet associated", 400);

            if(!$sender->Wallet->allow_send)
                throw new \Exception("Sender not allowed to Send Money", 400);

            if(!$receiver->Wallet->allow_receive)
                throw new \Exception("Receiver not allowed to Receive", 400);

            if($sender->Wallet->balance < $value)
                throw new \Exception("Sender does not have enough funds to execute this transaction", 400);

            $transaction = new Transaction();
            $transaction->FromWallet()->associate($sender->Wallet);
            $transaction->ToWallet()->associate($receiver->Wallet);
            $transaction->value = $value;
            $isAuthorized = $this->transactionManager->IsTransactionAuthorized($transaction);

            if(!$isAuthorized)
                throw new \Exception("Transaction was not Authorized by the Bank", 422);

            $transactionRepo = $this->repositoryFactory->GetTransactionRepository();
            $walletRepo = $this->repositoryFactory->GetAccountRepository();

            $transactionRepo->Create($transaction);
            $transactionRepo->Commit();

            $senderWallet = $sender->Wallet;
            $receiverWallet = $receiver->Wallet;
            $senderWallet->balance -= $value;
            $receiverWallet->balance += $value;

            $walletRepo->Update($senderWallet->id, $senderWallet);
            $walletRepo->Update($receiverWallet->id, $receiverWallet);
            $walletRepo->Commit();

            TransactionSuccess::dispatch($sender->getFullName(), $receiver->getFullName(), $receiver->email, $value);

            return true;

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            TransactionError::dispatch($value, $e->getMessage());
            throw $e;
        }
    }
}
