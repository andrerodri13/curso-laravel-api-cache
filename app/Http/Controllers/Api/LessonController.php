<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateLessonRequest;
use App\Http\Resources\LessonResource;
use App\Services\LessonService;
use Symfony\Component\HttpFoundation\Response;

class LessonController extends Controller
{
    /**
     * @var LessonService
     */
    private $lessonService;

    /**
     * LessonController constructor.
     */
    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(string $course)
    {
        $lesson = $this->lessonService->getLessonsByModule($course);
        return LessonResource::collection($lesson);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return LessonResource
     */
    public function store(StoreUpdateLessonRequest $request, string $course)
    {
        $module = $this->lessonService->createNewLesson($request->validated());

        return new LessonResource($module);
    }

    /**
     * Display the specified resource.
     *
     * @param string $identify
     * @return LessonResource
     */
    public function show(string $course, string $identify)
    {
        $module = $this->lessonService->getLessonByModule($course, $identify);
        return new LessonResource($module);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $identify
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreUpdateLessonRequest $request, string $course, string $identify)
    {
        $this->lessonService->updateLesson($identify, $request->validated());
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
        $this->lessonService->deleteLessonByUuid($identify);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
