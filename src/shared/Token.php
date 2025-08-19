<?php

namespace Devvime\shared;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Token
{
    public static function encode(string | array | object $value)
    {
        return JWT::encode($value, SECRET, 'HS256');
    }

    public static function decode(string | array | object $value)
    {
        return JWT::decode($value, new Key(SECRET, 'HS256'));
    }
}
