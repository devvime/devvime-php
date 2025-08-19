<?php

namespace Devvime\shared;

use Medoo\Medoo;

class Database
{
    private $db;

    public function __construct()
    {
        $this->db = new Medoo([
            'database_type' => DATABASE_TYPE,
            'database_name' => DATABASE_NAME,
            'server' => DATABASE_SERVER,
            'username' => DATABASE_USER,
            'password' => DATABASE_PASSWORD,
            'port' => DATABASE_PORT,
            'charset' => 'utf8mb4'
        ]);
    }

    public function connect()
    {
        return $this->db;
    }
}
