<?php
// Простой тестовый эндпоинт
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $dsn = sprintf(
        "mysql:host=%s;dbname=%s;charset=%s",
        "94.156.112.82",
        "admin_testing",
        "utf8mb4"
    );
/*
 *    sudo mysql -u root -p
   GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'uA8uY5wW2rqE';
   FLUSH PRIVILEGES;
 */
    try {
        $instance = new PDO($dsn, "root", "uA8uY5wW2rqE", [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]);

        var_dump($instance);
    } catch (PDOException $e) {
        throw new Exception("Ошибка подключения к базе данных: " . $e->getMessage());
    }

    echo json_encode([
        'status' => 'success',
        'message' => 'PHP API работает!'
    ]);
} 