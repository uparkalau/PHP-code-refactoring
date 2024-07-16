<?php

namespace App\Database;

use PDO;
use PDOException;
use App\Logger\Logger;

class Database {
    private ?PDO $conn = null;

    public function __construct(array $config) {
        try {
            $this->conn = new PDO(
                "mysql:host={$config['dbHost']};dbname={$config['dbName']}",
                $config['dbUser'],
                $config['dbPass']
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            Logger::log($e->getMessage());
            echo "A database connection error occurred. Please try again later.";
        }
    }

    public function saveBatchData(array $items): void {
        $sql = "INSERT INTO items (title, description, price) VALUES (:title, :description, :price)";
        $stmt = $this->conn->prepare($sql);

        try {
            $this->conn->beginTransaction();
            foreach ($items as $item) {
                $stmt->bindParam(':title', $item['title']);
                $stmt->bindParam(':description', $item['description']);
                $stmt->bindParam(':price', $item['price']);
                $stmt->execute();
            }
            $this->conn->commit();
        } catch (PDOException $e) {
            $this->conn->rollBack();
            Logger::log($e->getMessage());
            echo "Error: " . $e->getMessage();
        }
    }

    public function __destruct() {
        $this->conn = null;
    }
}