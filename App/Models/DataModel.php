<?php

namespace App\Models;

use PDO;
use PDOException;
use App\Logger\Logger;

class DataModel {
    private ?PDO $conn = null;

    public function __construct(array $config) {
        try {
            $this->conn = new PDO(
                "mysql:host={$config['dbHost']};dbname={$config['dbName']}",
                $config['dbUser'],
                $config['dbPass']
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            Logger::log("[" . date('Y-m-d H:i:s') . "] Database connection successful.");
        } catch (PDOException $e) {
            Logger::log("[" . date('Y-m-d H:i:s') . "] " . $e->getMessage());
            echo "A database connection error occurred. Please try again later.";
        }
    }

    private function executeStatement(string $sql, array $params): void {
        $stmt = $this->conn->prepare($sql);

        try {
            foreach ($params as $param => $value) {
                $stmt->bindValue($param, $value);
            }
            $stmt->execute();
        } catch (PDOException $e) {
            $this->handleException($e);
        }
    }

    private function handleException(PDOException $e): void {
        if ($this->conn->inTransaction()) {
            $this->conn->rollBack();
        }
        Logger::log("[" . date('Y-m-d H:i:s') . "] " . $e->getMessage());
        echo "An error occurred while saving data. Please try again later.";
    }

    public function saveBatchData(array $items): void {
        $sql = "INSERT INTO items (title, description, price) VALUES (:title, :description, :price)";

        try {
            $this->conn->beginTransaction();
            foreach ($items as $item) {
                $this->executeStatement($sql, [
                    ':title' => $item['title'],
                    ':description' => $item['description'],
                    ':price' => $item['price']
                ]);
            }
            $this->conn->commit();
        } catch (PDOException $e) {
            $this->handleException($e);
        }
    }

    public function saveData(string $name, string $description, float $price): void {
        $sql = "INSERT INTO items (name, description, price) VALUES (:name, :description, :price)";
        $this->executeStatement($sql, [
            ':name' => $name,
            ':description' => $description,
            ':price' => $price
        ]);
    }

    public function fetchAllData(): array {
        $stmt = $this->conn->query("SELECT title, description, price FROM items");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function __destruct() {
        $this->conn = null;
    }
}