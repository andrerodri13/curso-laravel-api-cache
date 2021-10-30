<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateModuleRequest;
use App\Http\Resources\ModuleResource;
use App\Services\ModuleService;
use Symfony\Component\HttpFoundation\Response;

class ModuleController extends Controller
{
    /**
     * @var ModuleService
     */
    private $moduleService;

    /**
     * ModuleController constructor.
     */
    public function __construct(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(string $course)
    {
        $modules = $this->moduleService->getModulesByCourse($course);
        return ModuleResource::collection($modules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return ModuleResource
     */
    public function store(StoreUpdateModuleRequest $request, string $course)
    {
        $module = $this->moduleService->createNewModule($request->validated());

        return new ModuleResource($module);
    }

    /**
     * Display the specified resource.
     *
     * @param string $identify
     * @return ModuleResource
     */
    public function show(string $course, string $identify)
    {
        $module = $this->moduleService->getModuleByCourse($course, $identify);
        return new ModuleResource($module);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $identify
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreUpdateModuleRequest $request, string $course, string $identify)
    {
        $this->moduleService->updateModule($identify, $request->validated());
        return response()->json(['message' => 'Updated'], Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $identify
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $course, string $identify)
    {
        $this->moduleService->deleteModuleByUuid($identify);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
