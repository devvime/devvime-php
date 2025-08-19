<?php

namespace Devvime\application\service;

use DomainException;
use Devvime\application\repository\User;
use Devvime\application\useCase\user\SendActivationEmail;

class UserService
{
    public function __construct(
        public User $user = new User(),
        private SendActivationEmail $sendActivationEmail = new SendActivationEmail()
    ) {}

    public function registerUser($request, $response)
    {
        try {
            $password = password_hash($request->body->password, PASSWORD_DEFAULT);
            $user = [
                "name" => $request->body->name,
                "email" => $request->body->email,
                "password" => $password
            ];
            $this->user->create($user);
            $this->sendActivationEmail->execute($user);
            return [
                "status" => 200,
                "message" => "User registered succesfull!"
            ];
        } catch (DomainException $error) {
            throw new DomainException($error);
        }
    }

    public function listAllUsers(array $filters = [])
    {
        try {
            $page = !empty($filters['page']) ? $filters['page'] : 1;
            $perPage = !empty($filters['perPage']) ? $filters['perPage'] : 5;
            $users = $this->user->getAll(filters: $filters, page: $page, perPage: $perPage);
            return $users;
        } catch (DomainException $error) {
            throw new DomainException($error);
        }
    }

    public function listUserById($id)
    {
        try {
            $user = $this->user->getById($id);
            if ($user) {
                return $user;
            }
            return [
                "status" => 404,
                "message" => "User not found."
            ];
        } catch (DomainException $error) {
            throw new DomainException($error);
        }
    }

    public function updateUser($request, $response)
    {
        try {
            $this->user->update($request->params['id'], $request->body);
            return [
                "status" => 200,
                "message" => "User updated successfully!"
            ];
        } catch (DomainException $error) {
            throw new DomainException($error);
        }
    }

    public function deleteUser($id)
    {
        try {
            $this->user->delete($id);
            return [
                "status" => 200,
                "message" => "User deleted successfully."
            ];
        } catch (DomainException $error) {
            throw new DomainException($error);
        }
    }
}
