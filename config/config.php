<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

return [
    'apiUrl' => $_ENV['API_URL'],
    'dbHost' => $_ENV['DB_HOST'],
    'dbName' => $_ENV['DB_NAME'],
    'dbUser' => $_ENV['DB_USER'],
    'dbPass' => $_ENV['DB_PASS']
];