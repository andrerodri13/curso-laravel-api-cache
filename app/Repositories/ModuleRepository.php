<?php


namespace App\Repositories;


use App\Models\Course;
use App\Models\Module;
use Illuminate\Support\Facades\Cache;

class ModuleRepository
{
    /**
     * @var Course
     */
    private $entity;


    /**
     * CourseRepository constructor.
     */
    public function __construct(Module $module)
    {
        $this->entity = $module;
    }

    public function getModuleCourse(int $course)
    {
        return $this->entity->where('course_id', $course)->get();
    }

    public function createNewModule(int $course, array $data)
    {
        $data['course_id'] = $course;
        return $this->entity->create($data);
    }

    public function getModuleByCourse(int $course, string $identify)
    {
        return $this->entity->where(['course_id' => $course, 'uuid' => $identify])->firstOrFail();
    }

    public function getModuleByUuid(string $identify)
    {
        return $this->entity->where('uuid', $identify)->firstOrFail();
    }

    public function deleteModuleByUuid(string $identify)
    {
        $module = $this->getModuleByUuid($identify);
        return $module->delete();
    }

    public function updateModuleByUuid(int $course, string $identify, array $data)
    {
        $data['course_id'] = $course;
        $module = $this->getModuleByUuid($identify);
        Cache::forget('courses');
        return $module->update($data);
    }

}
