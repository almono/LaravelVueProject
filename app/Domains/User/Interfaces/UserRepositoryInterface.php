<?php

namespace App\Domains\User\Interfaces;

use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function getAllUsers() : Collection;
    public function registerUser(array $data) : User;
}
