<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

// Pré-flight
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

# ########################################################
# Dirs ###################################################
define('ROOT', dirname(__DIR__, 3));
define('VIEWS_DIR', dirname(__DIR__, 2) . "/views");
# ########################################################

# ########################################################
# Environment ############################################
try {
    $dotenv = Dotenv\Dotenv::createImmutable(ROOT)->load();
} catch (\Exception $error) {
    error_log(".env not found");
    http_response_code(500);
    echo json_encode(["error" => ".env not found"]);
    exit;
}
# ########################################################

# ########################################################
# Database ###############################################
define('DATABASE_SERVER', $_ENV['DATABASE_SERVER']);
define('DATABASE_TYPE', $_ENV['DATABASE_TYPE']);
define('DATABASE_NAME', $_ENV['DATABASE_NAME']);
define('DATABASE_USER', $_ENV['DATABASE_USER']);
define('DATABASE_PASSWORD', $_ENV['DATABASE_PASSWORD']);
define('DATABASE_PORT', $_ENV['DATABASE_PORT']);
# ########################################################

# ########################################################
# Mail ###################################################
define('EMAIL_HOST', $_ENV['EMAIL_HOST']);
define('EMAIL_USER', $_ENV['EMAIL_USER']);
define('EMAIL_PASSWORD', $_ENV['EMAIL_PASSWORD']);
define('EMAIL_PORT', $_ENV['EMAIL_PORT']);
# ########################################################

# ########################################################
# Secret #################################################
define('SECRET', $_ENV['SECRET']);
# ########################################################

# ########################################################
# Session ################################################
session_set_cookie_params([
    'lifetime' => 0,
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
]);
session_start();
session_regenerate_id(true);
# ########################################################

# ########################################################
# Rate limit #############################################
try {
    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379);
    $ip = $_SERVER['REMOTE_ADDR'];
    $key = "ratelimit:$ip";
    $count = $redis->incr($key);

    if ($count == 1) {
        $redis->expire($key, 60);
    }

    if ($count > 5) {
        http_response_code(429);
        echo json_encode(["error" => "Rate limit exceeded"]);
        exit;
    }
} catch (Exception $e) {
    error_log("Redis error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(["error" => "Internal server error"]);
    exit;
}
# ########################################################
