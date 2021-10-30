<?php


namespace App\Services;


use App\Repositories\CourseRepository;

class CourseService
{
    /**
     * @var CourseRepository
     */
    private $repository;

    /**
     * CourseService constructor.
     */
    public function __construct(CourseRepository $courseRepository)
    {
        $this->repository = $courseRepository;
    }

    public function getCourses()
    {
        return $this->repository->getAllCourses();
    }

    public function createNewCourse(array $data)
    {
        return $this->repository->createNewCourse($data);
    }

    public function getCourseByUuid(string $identify)
    {
        return $this->repository->getCourseByUuid($identify);
    }

    public function deleteCourseByUuid(string $identify)
    {
        return $this->repository->deleteCourseByUuid($identify);
    }

    public function updateCourse(string $identify, array $data)
    {
        return $this->repository->updateCourseByUuid($identify, $data);
    }
}
