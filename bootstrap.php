<?php

require_once __DIR__ . '/vendor/autoload.php';

$config = require __DIR__ . '/config/config.php';

use App\Api\ApiClient;
use App\Database\Database;
use App\Service\DataService;

$database = new Database($config);
$apiClient = new ApiClient($config['apiUrl']);
$dataService = new DataService($apiClient, $database);

$dataService->processData();