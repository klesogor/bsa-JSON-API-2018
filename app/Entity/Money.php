<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Money extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'wallet_id',
        'amount',
        'currency_id'
    ];

    protected $table = 'money';



    public function currency()
    {
        return $this->belongsTo(Currency::class,'currency_id');
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class,'wallet_id');
    }
}
