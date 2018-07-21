<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name',
        'email'
    ];

    protected $table = 'user';

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

}
