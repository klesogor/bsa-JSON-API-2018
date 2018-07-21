<?php

namespace App\Requests;

use App\Entity\Wallet;
use Illuminate\Support\Facades\Validator;

class CreateWalletRequest
{

    private $userId;

    function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

}

