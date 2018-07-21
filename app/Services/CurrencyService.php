<?php
/**
 * Created by PhpStorm.
 * User: Anatolich
 * Date: 10.07.2018
 * Time: 12:08
 */

namespace App\Services;


use App\Entity\Currency;
use App\Requests\CreateCurrencyRequest;

class CurrencyService implements CurrencyServiceInterface
{

    public function create(CreateCurrencyRequest $request): Currency
    {
        return Currency::create([
                'name' => $request->getName()
            ]);
    }
}