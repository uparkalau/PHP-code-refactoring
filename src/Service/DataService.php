<?php

namespace App\Service;

use App\Api\ApiClient;
use App\Database\Database;

class DataService {
    private ApiClient $apiClient;
    private Database $database;

    public function __construct(ApiClient $apiClient, Database $database) {
        $this->apiClient = $apiClient;
        $this->database = $database;
    }

    public function processData(): void {
        $data = $this->apiClient->fetchData();
        $this->database->saveBatchData($data);
    }
}