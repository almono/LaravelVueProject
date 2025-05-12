<?php

namespace App\Domains\Module\Repositories;

use Illuminate\Database\Eloquent\Collection;

use App\Domains\Module\Interfaces\ModuleRepositoryInterface;
use App\Domains\Module\Models\Module;

class ModuleRepository implements ModuleRepositoryInterface
{
    public function getAllModules() : Collection
    {
        return Module::all();
    }
}