<?php

namespace App\Domains\User\Services;

use App\Domains\User\Models\User;
use App\Domains\User\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    public function getAllUsers() : Collection
    {
        return $this->userRepository->getAllUsers();
    }

    public function registerUser(array $data) : User 
    {
        $data['password'] = bcrypt($data['password']);
        return $this->userRepository->registerUser($data);
    }

    public function createUserToken(User $user) : string
    {
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;
        return $token;
    }

    public function grantModuleAccess(int $userId, int $moduleId): void
    {
        $user = $this->userRepository->find($userId);
        if ($user) {
            $this->userRepository->giveAccessToModule($user, $moduleId);
        }
    }
}