<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TaskRepository;
use App\Form\TaskType;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Route("/task")
 */
class TaskController extends AbstractController
{
    /**
     * Lista tarefas do banco de dados
     * @Route("/", name="tasks_index", methods="GET")
     *
     * @return Response
     */
    public function index(TaskRepository $repository): Response
    {
        return $this->render("tasks/index.html.twig", [
            "tasks" => $repository->findAll()
        ]);
    }

    /**
     * Cria uma nova tarefa no banco de dados
     * @Route("/new", name="tasks_new", methods={"GET", "POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $form = $this->createForm(TaskType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['attachment']->getData();
            $file->move('files', $file->getClientOriginalName());

            $task = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();
    
            return $this->redirectToRoute("tasks_show", ["id" => $task->getId()]);
        }

        return $this->render("tasks/new.html.twig", [
            "formulario" => $form->createView()
        ]);
    }

     /**
     * Mostra uma tarefa especifica
     * @Route("/{id}", name="tasks_show", methods="GET")
     *
     * @param Task $task
     * @return Response
     */
    public function show(Task $task): Response
    {
        return $this->render("tasks/show.html.twig", [
            "task" => $task
        ]);
    }


    /**
     * Edita uma tarefa no banco de dados
     * @Route("/{id}/edit", name="tasks_edit", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param Task $task
     * @return Response
     */
    public function edit(Request $request, Task $task): Response
    {
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute("tasks_show", ["id" => $task->getId()]);
        }

        return $this->render("tasks/edit.html.twig", [
            "task" => $task,
            "formulario" => $form->createView()
        ]);
    }

    /**
     * Apaga uma tarefa no banco de dados
     * @Route("/{id}", name="tasks_delete", methods="DELETE")
     *
     * @param Task $task
     * @return Response
     */
    public function delete(Task $task, Request $request): Response
    {
        $isTokenValid = $this->isCsrfTokenValid('deletar_tarefa', $request->request->get('_token'));

        if ($isTokenValid) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($task);
            $entityManager->flush();
        }
        
        return $this->redirectToRoute("tasks_index");
    }
}