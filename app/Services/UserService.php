<?php
/**
 * Created by PhpStorm.
 * User: Anatolich
 * Date: 10.07.2018
 * Time: 12:28
 */

namespace App\Services;


use App\Entity\User;
use App\Requests\SaveUserRequest;
use Illuminate\Support\Collection;

class UserService implements UserServiceInterface
{

    public function findAll(): Collection
    {
        return User::all();
    }

    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    public function save(SaveUserRequest $request): User
    {
       $user = User::find($request->getId());
       if(is_null($user) && !is_null(User::where('email',$request->getEmail()))){
           throw new \LogicException('User with this email already exists!');
       } else {
           $user = new User;
       }
       $user->fill([
                'name' => $request->getName(),
                'email' => $request->getEmail()
             ])
            ->save();
       return $user;
    }

    public function delete(int $id): void
    {
        User::find($id)->delete();
    }
}