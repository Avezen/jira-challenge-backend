<?php
/**
 * Created by PhpStorm.
 * User: Maciej Borzymowski
 * Date: 2020-05-03
 * Time: 13:04
 */

namespace App\CQRS\Stage\Application\Read\Handler;


use App\CQRS\Category\Application\Read\Model\Collection\Single\Category;
use App\CQRS\Stage\Application\Read\Model\Collection\Single\Stage;
use App\CQRS\Stage\Application\Read\Model\Collection\StageList;
use App\CQRS\Stage\Application\Read\Query\StagesWithActiveTasksQuery;
use App\CQRS\Stage\Application\Read\StageInterface;
use App\CQRS\Stage\Infrastructure\StageRepository;
use App\CQRS\Task\Application\Read\Model\Collection\Single\Task;
use App\CQRS\Task\Application\Read\Model\Collection\TaskList;
use App\CQRS\TaskStep\Application\Read\Model\Collection\Single\TaskStep;
use App\CQRS\TaskStep\Application\Read\Model\Collection\TaskStepList;
use App\CQRS\User\Application\Read\Model\Collection\Single\User;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class StagesWithActiveTasksQueryHandler implements MessageHandlerInterface
{
    private $stageRepository;

    public function __construct(StageRepository $stageRepository)
    {
        $this->stageRepository = $stageRepository;
    }

    public function __invoke(StagesWithActiveTasksQuery $stagesWithActiveTasksQuery)
    {
        // Todo create factory for models creation
        $stageList = [];
        foreach ($this->stageRepository->findAll() as $stage){
            $stageModel = new Stage();
            $stageModel->id = $stage->getId();
            $stageModel->name = $stage->getName();

            $taskList = [];
            foreach ($stage->getTasks() as $task){
                $taskModel = new Task();
                $taskModel->id = $task->getId();
                $taskModel->name = $task->getName();

                $taskStepList = [];
                foreach ($task->getTaskSteps() as $taskStep){
                    $taskStepModel = new TaskStep();
                    $taskStepModel->id = $taskStep->getId();
                    $taskStepModel->name = $taskStep->getName();

                    $taskStepList[] = $taskStepModel;
                }

                $createdBy = $task->getCreatedBy();
                $createdByModel = new User();
                $createdByModel->username = $createdBy->getUsername();

                $createdFor = $task->getCreatedFor();
                $createdForModel = new User();
                $createdForModel->username = $createdFor->getUsername();

                $category = $task->getCategory();
                $categoryModel = new Category();
                $categoryModel->id = $category->getId();
                $categoryModel->name = $category->getName();

                $taskModel->taskSteps = $taskStepList;
                $taskModel->createdBy = $createdByModel;
                $taskModel->createdFor = $createdForModel;
                $taskModel->category = $categoryModel;

                $taskList[] = $taskModel;
            }

            $stageModel->tasks = $taskList;

            $stageList[] = $stageModel;
        }

        return $stageList;
    }
}