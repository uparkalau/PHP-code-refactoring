<?php

class Config {
    public static $apiUrl = "https://api.example.com/data";
    public static $dbHost = "localhost";
    public static $dbName = "my_database";
    public static $dbUser = "root";
    public static $dbPass = "password";
}

class Database {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli(Config::$dbHost, Config::$dbUser, Config::$dbPass, Config::$dbName);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function saveData($name, $description, $price) {
        $sql = "INSERT INTO items (name, description, price) VALUES ('$name', '$description', '$price')";
        if (!$this->conn->query($sql)) {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    public function __destruct() {
        $this->conn->close();
    }
}

class ApiClient {
    public function fetchData() {
        $response = file_get_contents(Config::$apiUrl);
        return json_decode($response, true);
    }
}

$database = new Database();
$client = new ApiClient();
$data = $client->fetchData();

foreach ($data as $item) {
    $database->saveData($item['name'], $item['description'], $item['price']);
}
?>
