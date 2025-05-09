<?php

namespace App\Services;

use App\Repositories\ModuleRepository;
use Illuminate\Database\Eloquent\Collection;

class ModuleService
{
    public function __construct(
        private ModuleRepository $moduleRepository
    ) {}

    public function getAllModules() : Collection
    {
        return $this->moduleRepository->getAllModules();
    }
}