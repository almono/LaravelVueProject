<?php

namespace App\Domains\User\Repositories;

use App\Domains\User\Interfaces\UserRepositoryInterface;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers() : Collection
    {
        return User::all();
    }

    public function registerUser(array $data) : User
    {
        return User::create($data);
    }

    public function find(int $id): ?User
    {
        return User::find($id);
    }

    public function giveAccessToModule(User $user, int $moduleId): void
    {
        $user->modules()->syncWithoutDetaching([$moduleId]);
    }
}