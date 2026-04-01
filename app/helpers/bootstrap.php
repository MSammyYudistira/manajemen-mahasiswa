<?php

declare(strict_types=1);

if (getenv('VERCEL')) {
    $temporarySessionPath = sys_get_temp_dir();

    if (is_dir($temporarySessionPath) && is_writable($temporarySessionPath)) {
        session_save_path($temporarySessionPath);
    }
}

session_start();

define('BASE_PATH', dirname(__DIR__, 2));

$appConfig = require BASE_PATH . '/app/config/app.php';
$databaseConfig = require BASE_PATH . '/app/config/database.php';

require BASE_PATH . '/app/helpers/functions.php';
require BASE_PATH . '/app/helpers/auth.php';

function db(): PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    global $databaseConfig;

    $dsn = sprintf(
        'mysql:host=%s;port=%s;dbname=%s;charset=%s',
        $databaseConfig['host'],
        $databaseConfig['port'],
        $databaseConfig['database'],
        $databaseConfig['charset']
    );

    $pdo = new PDO(
        $dsn,
        $databaseConfig['username'],
        $databaseConfig['password'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );

    return $pdo;
}
