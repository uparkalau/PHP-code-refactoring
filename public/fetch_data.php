<?php

require_once __DIR__ . '/../vendor/autoload.php';

$config = require __DIR__ . '/../config/config.php';

use App\Controllers\DataController;
use App\Models\DataModel;
use App\Api\ApiClient;

$dataModel = new DataModel($config);
$apiClient = new ApiClient($config['apiUrl']);
$dataController = new DataController($dataModel, $apiClient);

$dataController->fetchData();
$data = $dataController->getData();

echo json_encode($data);