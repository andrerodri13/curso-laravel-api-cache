<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCourseRequest;
use App\Http\Resources\CourseResource;
use App\Services\CourseService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends Controller
{
    /**
     * @var CourseService
     */
    private $courseService;

    /**
     * CourseController constructor.
     */
    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $courses = $this->courseService->getCourses();
        return CourseResource::collection($courses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return CourseResource
     */
    public function store(StoreUpdateCourseRequest $request)
    {
        $course = $this->courseService->createNewCourse($request->validated());

        return new CourseResource($course);
    }

    /**
     * Display the specified resource.
     *
     * @param string $identify
     * @return CourseResource
     */
    public function show(string $identify)
    {
        $course = $this->courseService->getCourseByUuid($identify);
        return new CourseResource($course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $identify
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreUpdateCourseRequest $request, string $identify)
    {
        $this->courseService->updateCourse($identify, $request->validated());
        return response()->json(['message' => 'Updated'], Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $identify
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $identify)
    {
        $this->courseService->deleteCourseByUuid($identify);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
