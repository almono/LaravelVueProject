<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
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
}