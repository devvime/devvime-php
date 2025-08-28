<?php

namespace Devvime\http\middleware;

use ModPath\Interface\MiddlewareInterface;
use ModPath\Helpers\Token;

class AuthMiddleware implements MiddlewareInterface
{
    public function handle(): bool
    {
        if (Token::decode(Token::get())) {
            return true;
        }
        return false;
    }
}
