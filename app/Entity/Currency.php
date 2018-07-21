<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $table = 'currency';

    public $timestamps = false;

    public function money()
    {
        return $this->hasMany(Money::class,'currency_id');
    }

}
