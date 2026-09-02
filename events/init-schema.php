<?php
echo "Starting schema initialization..." . PHP_EOL;
require_once __DIR__ . '/config.php';

$dbConfig = getDatabaseConfig();
$dsn = $dbConfig['dsn'];
$user = $dbConfig['user'];
$pass = $dbConfig['pass'];

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    $pdo->exec('CREATE TABLE IF NOT EXISTS registrations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        fio VARCHAR(255) NOT NULL,
        phone VARCHAR(20) NOT NULL UNIQUE,
        event_date DATE NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )');

    echo "Table 'registrations' created successfully." . PHP_EOL;

    try {
        $pdo->exec('CREATE INDEX idx_event_date ON registrations (event_date)');
        echo "Index 'idx_event_date' created successfully." . PHP_EOL;
    } catch (PDOException $indexException) {
        $errorInfo = $indexException->errorInfo;
        if (isset($errorInfo[1]) && (int)$errorInfo[1] === 1061) {
            echo "Index 'idx_event_date' already exists." . PHP_EOL;
        } else {
            throw $indexException;
        }
    }

    echo "Schema initialized successfully." . PHP_EOL;
} catch (PDOException $e) {
    echo "Schema initialization failed: " . $e->getMessage() . PHP_EOL;
    exit(1);
}
