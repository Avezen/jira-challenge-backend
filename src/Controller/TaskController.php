<?php

namespace App\Controller;

use App\CQRS\Stage\Domain\Stage;
use App\CQRS\Task\Application\Read\Query\TaskQuery;
use App\CQRS\Task\Application\Write\Command\CreateTaskCommand;
use App\CQRS\Task\Application\Write\Command\UpdateTaskStageCommand;
use App\CQRS\Task\Domain\Task;
use App\Form\Task\TaskType;
use App\Request\Task\TaskRequest;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class TaskController extends ApiController
{
    /**
     * @Route("/", name="api")
     */
    public function api()
    {
        return $this->json(['authorized api!']);
    }

    /**
     * @Route("/task", name="get_task_list", methods="GET")
     */
    public function getTaskList()
    {
        $tasks = $this->queryBus->query(new TaskQuery());

        return $this->json($tasks);
    }

    /**
     * @Route("/stage/{stage}/task", name="create_task", methods="POST")
     * @param Request $request
     * @param Stage $stage
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function createTask(Request $request, Stage $stage)
    {
        $data = json_decode($request->getContent(), true);

        $taskRequest = new TaskRequest();
        $form = $this->createForm(TaskType::class, $taskRequest);
        $form->submit($data);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->commandBus->dispatch(new CreateTaskCommand($stage, $form->getData()));

            return $this->json('success', Response::HTTP_CREATED);
        }

        return $this->json('Validation error', Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/task/{task}/stage/{stage}", name="update_task_stage", methods="PATCH")
     * @param Task $task
     * @param Stage $stage
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function updateTaskStage(Task $task, Stage $stage)
    {
        $this->commandBus->dispatch(new UpdateTaskStageCommand($stage, $task));

        return $this->json('success', Response::HTTP_CREATED);
    }

    private function getErrorsFromForm(FormInterface $form)
    {
        $errors = array();
        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }
        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface) {
                if ($childErrors = $this->getErrorsFromForm($childForm)) {
                    $errors[$childForm->getName()] = $childErrors;
                }
            }
        }
        return $errors;
    }
}
