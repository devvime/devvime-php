<?php

use ModPath\Router\Router;
use Devvime\application\controller\SystemController;
use Devvime\application\controller\AuthController;
use Devvime\application\controller\UserController;

$router = new Router();

$router->registerRoutes([
    SystemController::class,
    AuthController::class,
    UserController::class
]);

$router->dispatch();
