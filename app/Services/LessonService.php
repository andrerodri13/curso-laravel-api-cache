<?php


namespace App\Services;


use App\Repositories\LessonRepository;
use App\Repositories\ModuleRepository;

class LessonService
{
    /**
     * @var LessonRepository
     */
    private $repository;
    /**
     * @var ModuleRepository
     */
    private $moduleRepository;

    /**
     * ModuleService constructor.
     */
    public function __construct(LessonRepository $lessonRepository, ModuleRepository $moduleRepository)
    {
        $this->repository = $lessonRepository;
        $this->moduleRepository = $moduleRepository;
    }


    public function getLessonsByModule(string $module)
    {
        $module = $this->moduleRepository->getModuleByUuid($module);
        return $this->repository->getLessonModule($module->id);
    }

    public function createNewLesson(array $data)
    {
        $module = $this->moduleRepository->getModuleByUuid($data['module']);
        return $this->repository->createNewLesson($module->id, $data);
    }

    public function getLessonByModule(string $module, string $identify)
    {
        $module = $this->moduleRepository->getModuleByUuid($module);

        return $this->repository->getLessonByModule($module->id, $identify);
    }

    public function deleteLessonByUuid(string $identify)
    {
        return $this->repository->deleteLessonByUuid($identify);
    }

    public function updateLesson(string $identify, array $data)
    {
        $module = $this->moduleRepository->getModuleByUuid($data['module']);

        return $this->repository->updateLessonByUuid($module->id, $identify, $data);
    }
}
