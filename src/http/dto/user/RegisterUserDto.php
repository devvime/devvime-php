<?php

namespace Devvime\http\dto\user;

use ModPath\Dto\Dto;

class RegisterUserDto extends Dto
{
    public array $allowed = ['name', 'email', 'password'];
    public array $rules = [
        'name' => ['required'],
        'email' => ['required', 'email'],
        'password' => ['required']
    ];
}
