<?php

namespace Devvime\application\controller;

use ModPath\Attribute\Route;
use ModPath\Attribute\Controller;

use Devvime\application\service\UserService;
use Devvime\application\service\AuthService;

#[Controller(path: '/auth')]
class AuthController
{
    public function __construct(
        public UserService $userService = new UserService(),
        public AuthService $authService = new AuthService(),
    ) {}

    #[Route(path: '/session', method: 'POST')]
    public function auth($request, $response)
    {
        $result = $this->authService->auth($request);
        $response->json($result);
    }

    #[Route(path: '/register', method: 'POST')]
    public function register($request, $response)
    {
        $result = $this->userService->registerUser($request, $response);
        $response->json($result);
    }

    #[Route(path: '/session/destroy', method: 'POST')]
    public function logout($request, $response)
    {
        $result = $this->authService->logout($request, $response);
        $response->json($result);
    }
}
