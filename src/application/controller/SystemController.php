<?php

namespace Devvime\application\controller;

use ModPath\Attribute\Route;
use ModPath\Attribute\Controller;

#[Controller(path: '/404')]
class SystemController
{
    public function __construct() {}

    #[Route(path: '', method: 'GET')]
    #[Route(path: '', method: 'POST')]
    #[Route(path: '', method: 'PUT')]
    #[Route(path: '', method: 'PATCH')]
    #[Route(path: '', method: 'DELETE')]
    public function auth($request, $response)
    {
        $response->send('ERROR 404: Route not found.');
    }
}
