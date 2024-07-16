<?php

namespace App\Controllers;

use App\Models\DataModel;
use App\Api\ApiClient;

class DataController {
    private DataModel $dataModel;
    private ApiClient $apiClient;

    public function __construct(DataModel $dataModel, ApiClient $apiClient) {
        $this->dataModel = $dataModel;
        $this->apiClient = $apiClient;
    }

    public function fetchData(): void {
        $data = $this->apiClient->fetchData();
        $this->dataModel->saveBatchData($data);
    }

    public function getData(): array {
        return $this->dataModel->fetchAllData();
    }
}