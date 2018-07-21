<?php

namespace Tests\Feature;


use App\Entity\User;
use CloudCreativity\LaravelJsonApi\Testing\MakesJsonApiRequests;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions,
        MakesJsonApiRequests;

    protected $api = 'v1';

    protected $resourceType = 'users';

    public function test_see_users()
    {
        $users = factory(User::class, 2)->create();
        $result = $this->doRead($users[0]);
        $this->assertNotNull($result);
    }

    public function test_add_user()
    {
        $data = [
            'type' => 'users',
            'attributes' => [
                'name' => 'Mogave',
                'email' => 'test@mail.com'
            ]
        ];

        $id = $this
            ->doCreate($data)
            ->assertCreatedWithId($data);
        $this->assertDatabaseHas('user',[
            'id' => $id,
            'name' => 'Mogave',
            'email' => 'test@mail.com'
        ]);
    }

    public function test_update_user()
    {
        $user = factory(User::class)->create();
        $data = [
            'type' => 'users',
            'id' => (string) $user->id,
            'attributes' => [
                'name' => 'Mogave',
                'email' => 'test@mail.com'
            ]
        ];

        $this->doUpdate($data)->assertUpdated($data);

        $this->assertDatabaseHas('user',[
            'id' => $user->id,
            'name' => 'Mogave',
            'email' => 'test@mail.com'
        ]);
    }

    public function test_delete_user()
    {
        $user = factory(User::class)->create();
        $this->doDelete($user)->assertDeleted();
        $this->assertDatabaseMissing('user',['id'=>$user->id]);
    }
}