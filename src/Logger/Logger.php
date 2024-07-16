<?php

namespace App\Logger;

class Logger {
    public static function log(string $message): void {
        file_put_contents(__DIR__ . '/../../logs/app.log', $message . PHP_EOL, FILE_APPEND);
    }
}