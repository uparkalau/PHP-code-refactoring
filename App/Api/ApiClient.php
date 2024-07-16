<?php

namespace App\Api;

class ApiClient {
    private $apiUrl;

    public function __construct($apiUrl) {
        $this->apiUrl = $apiUrl;
    }

    public function fetchData() {
        $response = file_get_contents($this->apiUrl);
        return json_decode($response, true);
    }
}