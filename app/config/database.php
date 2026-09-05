<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$database['main'] = array(
    'driver'   => 'mysql',
    'hostname' => getenv('DB_HOST') ?: $_ENV['DB_HOST'],
    'port'     => getenv('DB_PORT') ?: $_ENV['DB_PORT'],
    'username' => getenv('DB_USER') ?: $_ENV['DB_USER'],
    'password' => getenv('DB_PASSWORD') ?: $_ENV['DB_PASSWORD'],
    'database' => getenv('DB_NAME') ?: $_ENV['DB_NAME'],
    'dbprefix' => '',
    'charset'  => 'utf8mb4',
    'path'     => ''
);

return $database;