<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$db['default'] = array(
	'hostname' => getenv('DB_HOST') ?: 'localhost',
	'username' => getenv('DB_USER') ?: 'root',
	'password' => getenv('DB_PASS') ?: '',
	'database' => getenv('DB_NAME') ?: '',
	'driver'   => 'mysqli',
	'port'     => getenv('DB_PORT') ?: 3306,
	'charset'  => 'utf8mb4',
	'collate'  => 'utf8mb4_unicode_ci',
	'prefix'   => '',
	'options'  => array(
		PDO::ATTR_PERSISTENT => FALSE,
		PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION
	)
);