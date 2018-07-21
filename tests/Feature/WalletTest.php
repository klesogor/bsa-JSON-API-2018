<?php

namespace Tests\Feature;


use App\Entity\User;
use App\Entity\Wallet;
use CloudCreativity\LaravelJsonApi\Testing\MakesJsonApiRequests;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class WalletTest extends TestCase
{
    use DatabaseTransactions,
        MakesJsonApiRequests;

    protected $api = 'v1';

    protected $resourceType = 'wallets';

    public function test_see_walletss()
    {
        $user = factory(User::class)->create();
        $wallet = factory(Wallet::class)->make();
        $wallet->user_id = $user->id;
        $wallet->save();
        $result = $this->doRead($wallet);
        $this->assertNotNull($result);
    }

    public function test_add_wallet()
    {
        $user = factory(User::class)->create();
        $data = [
            'type' => 'wallets',
            'attributes' => [
                'user_id' => $user->id
            ]
        ];

        $id = $this
            ->doCreate($data)
            ->assertCreatedWithId($data);
        $this->assertDatabaseHas('wallet',[
            'id' => $id,
            'user_id' => $user->id
        ]);
    }

    public function test_update_wallet()
    {
        $user = factory(User::class)->create();
        $user1 = factory(User::class)->create();
        $wallet = factory(Wallet::class)->make();
        $wallet->user_id = $user->id;
        $wallet->save();
        $data = [
            'type' => 'wallets',
            'id' => (string) $wallet->id,
            'attributes' => [
                'user_id' => $user1->id
            ]
        ];

        $this->doUpdate($data)->assertUpdated($data);

        $this->assertDatabaseHas('wallet',[
            'id' => $wallet->id,
            'user_id' => $user1->id
        ]);
    }
    
}