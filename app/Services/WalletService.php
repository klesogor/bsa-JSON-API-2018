<?php
/**
 * Created by PhpStorm.
 * User: Anatolich
 * Date: 10.07.2018
 * Time: 12:33
 */

namespace App\Services;


use App\Entity\Currency;
use App\Entity\User;
use App\Entity\Wallet;
use App\Requests\CreateWalletRequest;
use Illuminate\Support\Collection;

class WalletService implements WalletServiceInterface
{
    public function findByUser(int $userId): ?Wallet
    {
        return Wallet::where('user_id',$userId)->first();
    }

    public function create(CreateWalletRequest $request): Wallet
    {
        if(!is_null($this->findByUser($request->getUserId())))
        {
            throw new \LogicException('User already has a wallet!');
        }
        return Wallet::create([
                'user_id' => $request->getUserId()
            ]);
    }

    public function findCurrencies(int $walletId): Collection
    {
        return Currency::whereHas('money',function($query) use ($walletId){
            $query->where('wallet_id',$walletId);
        })->get();
    }
}