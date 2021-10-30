<?php


namespace App\Services;


use App\Repositories\CourseRepository;
use App\Repositories\ModuleRepository;

class ModuleService
{
    /**
     * @var CourseRepository
     */
    private $repository;
    /**
     * @var CourseRepository
     */
    private $courseRepository;

    /**
     * CourseService constructor.
     */
    public function __construct(ModuleRepository $moduleRepository, CourseRepository $courseRepository)
    {
        $this->repository = $moduleRepository;
        $this->courseRepository = $courseRepository;
    }


    public function getModulesByCourse(string $course)
    {
        $course = $this->courseRepository->getCourseByUuid($course);
        return $this->repository->getModuleCourse($course->id);
    }

    public function createNewModule(array $data)
    {
        $course = $this->courseRepository->getCourseByUuid($data['course']);
        return $this->repository->createNewModule($course->id, $data);
    }

    public function getModuleByCourse(string $course, string $identify)
    {
        $course = $this->courseRepository->getCourseByUuid($course);

        return $this->repository->getModuleByCourse($course->id, $identify);
    }

    public function deleteModuleByUuid(string $identify)
    {
        return $this->repository->deleteModuleByUuid($identify);
    }

    public function updateModule(string $identify, array $data)
    {
        $course = $this->courseRepository->getCourseByUuid($data['course']);

        return $this->repository->updateModuleByUuid($course->id, $identify, $data);
    }
}
