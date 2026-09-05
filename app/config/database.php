<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$database['main'] = array(
    'driver'   => 'mysql',
    'hostname' => getenv('DB_HOST') ?: ($_ENV['DB_HOST'] ?? 'mysql-3f9df595-minsu-8c50.f.aivencloud.com'),
    'port'     => getenv('DB_PORT') ?: ($_ENV['DB_PORT'] ?? '28889'),
    'username' => getenv('DB_USER') ?: ($_ENV['DB_USER'] ?? 'avnadmin'),
    'password' => getenv('DB_PASSWORD') ?: ($_ENV['DB_PASSWORD'] ?? 'AVNS_DuPbA_70DduRAqTpJzL'),
    'database' => getenv('DB_NAME') ?: ($_ENV['DB_NAME'] ?? 'defaultdb'),
    'dbprefix' => '',
    'charset'  => 'utf8mb4',
    'path'     => ''
);

return $database;