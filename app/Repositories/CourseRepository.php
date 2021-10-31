<?php


namespace App\Repositories;


use App\Models\Course;
use Illuminate\Support\Facades\Cache;

class CourseRepository
{
    /**
     * @var Course
     */
    private $entity;


    /**
     * CourseRepository constructor.
     */
    public function __construct(Course $course)
    {
        $this->entity = $course;
    }

    public function getAllCourses()
    {
//        return Cache::remember('courses', 60, function () {
//           return $this->entity
//                ->with('modules.lessons')
//                ->get();
//        });

        return Cache::rememberForever('courses', function () {
            return $this->entity
                ->with('modules.lessons')
                ->get();
        });
    }

    public function createNewCourse(array $data)
    {
        return $this->entity->create($data);
    }

    public function getCourseByUuid(string $identify, bool $loadRelationships = true)
    {
        $query = $this->entity->where('uuid', $identify);
        if ($loadRelationships) {
            $query->with('modules.lessons');
        }
        return $query->firstOrFail();
    }

    public function deleteCourseByUuid(string $identify)
    {
        $course = $this->getCourseByUuid($identify, false);
        return $course->delete();
    }

    public function updateCourseByUuid(string $identify, array $data)
    {
        $course = $this->getCourseByUuid($identify, false);
        Cache::forget('courses');

        return $course->update($data);
    }

}
