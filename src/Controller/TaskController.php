<?php

namespace App\Controller;

use App\CQRS\Task\Application\Read\Query\TaskQuery;
use App\CQRS\Task\Application\Write\Command\CreateTaskCommand;
use App\Form\Task\TaskType;
use App\Request\Task\TaskRequest;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/task", name="post_task", methods="POST")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function postTask(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $taskRequest = new TaskRequest();
        $form = $this->createForm(TaskType::class, $taskRequest);
        $form->submit($data);

//        dd($this->getErrorsFromForm($form));
        $tasks = [];
        if ($form->isSubmitted() && $form->isValid()) {
            $columnId = 1;
            $tasks = $this->commandBus->dispatch(new CreateTaskCommand($columnId, $form->getData()));
        }

        return $this->json($tasks);
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
