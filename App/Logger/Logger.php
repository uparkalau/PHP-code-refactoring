<?php

namespace App\Logger;

class Logger {
    public static function log(string $message): void {
        $date = date('dmY');
        $logDir = __DIR__ . '/../../logs';
        $logFile = "{$logDir}/{$date}-app.log";

        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }

        if (!file_exists($logFile)) {
            touch($logFile);
            chmod($logFile, 0644);
        }

        file_put_contents($logFile, $message . PHP_EOL, FILE_APPEND);
    }
}