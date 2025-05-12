<?php

namespace App\Domains\Module\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface ModuleRepositoryInterface
{
    public function getAllModules() : Collection;
}
