<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ClientController extends AbstractController
{
    /**
     * @Route("/client", name="client")
     */
    public function index(Request $request)
    {
        // var_dump(
        //     $request->query->all(),
        //     $request->query->get("teste", "padrao"),
        //     $request->query->get("pessoa")["idade"]
        // );

        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }
}
