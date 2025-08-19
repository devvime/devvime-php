<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class Users extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                "name" => "User 1",
                "email" => "user1@test.com",
                "password" => "user1"
            ],
            [
                "name" => "User 2",
                "email" => "user2@test.com",
                "password" => "user2"
            ],
            [
                "name" => "User 3",
                "email" => "user3@test.com",
                "password" => "user3"
            ],
            [
                "name" => "User 4",
                "email" => "user4@test.com",
                "password" => "user4"
            ],
            [
                "name" => "User 5",
                "email" => "user5@test.com",
                "password" => "user5"
            ],
            [
                "name" => "User 6",
                "email" => "user6@test.com",
                "password" => "user6"
            ],
            [
                "name" => "User 7",
                "email" => "user7@test.com",
                "password" => "user7"
            ],
            [
                "name" => "User 8",
                "email" => "user8@test.com",
                "password" => "user8"
            ],
            [
                "name" => "User 9",
                "email" => "user9@test.com",
                "password" => "user9"
            ],
            [
                "name" => "User 10",
                "email" => "user10@test.com",
                "password" => "user10"
            ],
        ];
        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
