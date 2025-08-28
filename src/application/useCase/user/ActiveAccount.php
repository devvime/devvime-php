<?php

namespace Devvime\application\useCase\user;

use DomainException;
use ModPath\Helpers\Token;
use Devvime\application\repository\User;

class ActiveAccount
{
    public function __construct(
        private User $user = new User()
    ) {}

    public function execute(string $token)
    {
        try {
            $user = Token::decode($token);
            $this->user->active($user->user_email);
        } catch (DomainException $error) {
            throw new DomainException($error);
        }
    }
}
