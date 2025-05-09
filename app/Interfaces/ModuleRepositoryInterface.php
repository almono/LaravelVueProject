<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface ModuleRepositoryInterface
{
    public function getAllModules() : Collection;
}
