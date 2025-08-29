<?php

namespace Devvime\http\middleware;

use Exception;
use ModPath\Interface\MiddlewareInterface;
use ModPath\Helpers\Token;

class AuthMiddleware implements MiddlewareInterface
{
    public function handle(): bool
    {
        if (isset($_SERVER['HTTP_AUTHORIZATION']) && Token::decode(Token::get())) {
            return true;
        }
        echo json_encode([
            "message" => "Unauthorized."
        ]);
        exit;
    }
}
