<?php

namespace Devvime\http\dto\user;

use ModPath\Dto\Dto;

class UpdateUserDto extends Dto
{
    public array $allowed = ['name', 'email', 'password', 'avatar'];
    public array $rules = [
        'email' => ['email']
    ];
}
