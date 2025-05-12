<?php

namespace App\Domains\Module\Services;

use Illuminate\Database\Eloquent\Collection;

use App\Domains\Module\Repositories\ModuleRepository;

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