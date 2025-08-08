<?php

define('ROOT', dirname(dirname(dirname(__DIR__))));

define('VIEWS_DIR', dirname(__DIR__, 2) . "/views");

session_set_cookie_params([
    'lifetime' => 0,
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
]);

session_start();
session_regenerate_id(true);

try {
    $dotenv = Dotenv\Dotenv::createImmutable(ROOT)->load();
} catch (\Exception $error) {
    echo ".env not found";
}
