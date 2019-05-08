<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use App\Controller\TaskController;

$routes = new RouteCollection;

$routes->add("lista", new Route("/lista", [
    "_controller" => [TaskController::class, "index"]
]));

return $routes;
