<?php


namespace App\Repositories;

use App\Models\Lesson;

class LessonRepository
{
    /**
     * @var Lesson
     */
    private $entity;


    /**
     * LessonRepository constructor.
     */
    public function __construct(Lesson $lesson)
    {
        $this->entity = $lesson;
    }

    public function getLessonModule(int $module)
    {
        return $this->entity->where('module_id', $module)->get();
    }

    public function createNewLesson(int $module, array $data)
    {
        $data['module_id'] = $module;
        return $this->entity->create($data);
    }

    public function getLessonByModule(int $module, string $identify)
    {
        return $this->entity->where(['module_id' => $module, 'uuid' => $identify])->firstOrFail();
    }

    public function getLessonByUuid(string $identify)
    {
        return $this->entity->where('uuid', $identify)->firstOrFail();
    }

    public function deleteLessonByUuid(string $identify)
    {
        $module = $this->getLessonByUuid($identify);
        return $module->delete();
    }

    public function updateLessonByUuid(int $module, string $identify, array $data)
    {
        $data['module_id'] = $module;
        $module = $this->getLessonByUuid($identify);
        return $module->update($data);
    }

}
