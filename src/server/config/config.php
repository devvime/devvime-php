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

define('DATABASE_SERVER', $_ENV['DATABASE_SERVER']);
define('DATABASE_TYPE', $_ENV['DATABASE_TYPE']);
define('DATABASE_NAME', $_ENV['DATABASE_NAME']);
define('DATABASE_USER', $_ENV['DATABASE_USER']);
define('DATABASE_PASSWORD', $_ENV['DATABASE_PASSWORD']);
define('DATABASE_PORT', $_ENV['DATABASE_PORT']);

define('EMAIL_HOST', $_ENV['EMAIL_HOST']);
define('EMAIL_USER', $_ENV['EMAIL_USER']);
define('EMAIL_PASSWORD', $_ENV['EMAIL_PASSWORD']);
define('EMAIL_PORT', $_ENV['EMAIL_PORT']);

define('SECRET', $_ENV['SECRET']);
