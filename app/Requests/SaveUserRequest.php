<?php

namespace App\Requests;

use App\Entity\User;
use Illuminate\Support\Facades\Validator;

class SaveUserRequest
{

    private $id;

    private $name;

    private $email;

    public function __construct(?int $id, string  $name, string $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

}

