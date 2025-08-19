<?php

namespace Devvime\http\dto\auth;

use ModPath\Dto\Dto;

class AuthDto extends Dto
{
    public array $allowed = ['email', 'password'];
    public array $rules = [
        'email' => ['required', 'email'],
        'password' => ['required']
    ];
}
