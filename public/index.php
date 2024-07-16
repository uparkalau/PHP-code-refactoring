<?php

require_once __DIR__ . '/../bootstrap.php';

use App\Controllers\DataController;
use App\Models\DataModel;
use App\Api\ApiClient;

$config = require __DIR__ . '/../config/config.php';

$dataModel = new DataModel($config);
$apiClient = new ApiClient($config['apiUrl']);
$dataController = new DataController($dataModel, $apiClient);

$data = $dataController->getData();

require_once __DIR__ . '/../app/Views/index.php';