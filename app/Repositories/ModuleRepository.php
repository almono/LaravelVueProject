<?php

namespace App\Repositories;

use App\Interfaces\ModuleRepositoryInterface;
use App\Models\Module;
use Illuminate\Database\Eloquent\Collection;

class ModuleRepository implements ModuleRepositoryInterface
{
    public function getAllModules() : Collection
    {
        return Module::all();
    }
}