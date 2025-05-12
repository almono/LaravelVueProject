<?php

namespace App\Domains\Module\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Domains\Module\Module;
use App\Domains\Module\ModuleService;

class ModuleController extends Controller
{
    public function __construct(
        private ModuleService $moduleService
    ) {}

    public function index() : JsonResponse
    {
        $modulesList = $this->moduleService->getAllModules();

        return response()->json([
            $modulesList
        ], empty($modulesList) ? Response::HTTP_NO_CONTENT : Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Module $module)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        //
    }
}
