<?php

namespace Devvime\application\controller;

use ModPath\Attribute\Route;
use ModPath\Attribute\Controller;

use Devvime\application\service\UserService;

#[Controller(path: '/user')]
class UserController
{
    public function __construct(
        private UserService $userService = new UserService()
    ) {}

    #[Route(path: '', method: 'GET')]
    public function index($request, $response)
    {
        $result = $this->userService->listAllUsers($request->query);
        $response->json($result);
    }

    #[Route(path: '/{id}', method: 'GET')]
    public function show($request, $response)
    {
        $result = $this->userService->listUserById($request->params['id']);
        $response->json($result);
    }

    #[Route(path: '', method: 'POST')]
    public function store($request, $response)
    {
        $result = $this->userService->registerUser($request, $response);
        $response->json($result);
    }

    #[Route(path: '/{id}', method: 'PUT')]
    public function update($request, $response)
    {
        $result = $this->userService->updateUser($request, $response);
        $response->json($result);
    }

    #[Route(path: '/{id}', method: 'DELETE')]
    public function destroy($request, $response)
    {
        $result = $this->userService->deleteUser($request->params['id']);
        $response->json($result);
    }
}
