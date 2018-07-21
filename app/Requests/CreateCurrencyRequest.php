<?php

namespace App\Requests;

use Illuminate\Support\Facades\Validator;

class CreateCurrencyRequest
{

    private $name;

    function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

}