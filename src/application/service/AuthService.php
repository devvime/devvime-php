<?php

namespace Devvime\application\service;

use DomainException;
use Devvime\Shared\Token;
use Devvime\application\repository\User;
use Devvime\application\useCase\user\SendActivationEmail;

class AuthService
{
    public function __construct(
        private User $user = new User(),
        private SendActivationEmail $sendActivationEmail = new SendActivationEmail()
    ) {}

    public function auth($request)
    {
        try {
            $user = $this->user->find('*', [
                "email" => $request->body->email
            ]);
            if (!$user) {
                return [
                    "error" => true,
                    "type" => "error",
                    "status" => 301,
                    "message" => "Email or password incorrect."
                ];
            }
            if (!$user['active']) {
                $this->sendActivationEmail->execute($user);
                return [
                    "error" => true,
                    "type" => "warning",
                    "status" => 301,
                    "message" => "User is not active, access your email {$request->body->email} and active your account."
                ];
            }
            if (password_verify(
                $request->body->password,
                $user['password']
            )) {
                $token = Token::encode([
                    "user_id" => $user['id'],
                    "user_name" => $user['name'],
                    "user_email" => $user['email']
                ]);
                $_SESSION['user'] = $token;
                return [
                    "token" => $_SESSION['user']
                ];
            }
        } catch (DomainException $error) {
            throw new DomainException($error);
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
        return [
            "success" => true,
            "message" => "Logout successfully"
        ];
    }
}
