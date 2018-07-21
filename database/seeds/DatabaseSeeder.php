<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $currencies = factory(\App\Entity\Currency::class,5)->create();
        $money = factory(\App\Entity\Money::class,10)->make();
        //bind currencies to money
        $money->each(function($item) use ($currencies){
            $item->currency_id = $currencies[rand(0,4)]->id;
        });
        $wallets = factory(\App\Entity\Wallet::class,2)->create();
        $wallets[0]->money()->saveMany($money->forPage(1,5));
        $wallets[1]->money()->saveMany($money->forPage(2,5));
    }
}
