<?php

use ModPath\Helpers\RateLimit;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

/* Pré-flight */
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

/* Dirs */
define('ROOT', dirname(__DIR__, 3));
define('VIEWS_DIR', dirname(__DIR__, 2) . "/views");

/* Environment */
try {
    $dotenv = Dotenv\Dotenv::createImmutable(ROOT)->load();
} catch (\Exception $error) {
    error_log(".env not found");
    http_response_code(500);
    echo json_encode(["error" => ".env not found"]);
    exit;
}

/* Session */
session_set_cookie_params([
    'lifetime' => 0,
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
]);
session_start();
session_regenerate_id(true);

/* Rate limit */
if (!RateLimit::execute(host: $_ENV['REDIS_HOST'], port: $_ENV['REDIS_PORT'])) {
    exit;
}
