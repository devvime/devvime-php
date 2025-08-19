<?php

use ModPath\Router\Router;
use Devvime\application\controller\SystemController;
use Devvime\application\controller\AuthController;

$router = new Router();

$router->registerRoutes([
    SystemController::class,
    AuthController::class
]);

$router->dispatch();
