<?php

use ModPath\Router\Router;
use Devvime\application\controller\UserController;

$router = new Router();

$router->registerRoutes([
    UserController::class
]);

$router->dispatch();
