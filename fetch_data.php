<?php

require_once __DIR__ . '/vendor/autoload.php';

$config = require __DIR__ . '/config/config.php';

use App\Api\ApiClient;

$apiClient = new ApiClient($config['apiUrl']);
$data = $apiClient->fetchData();

echo json_encode($data);