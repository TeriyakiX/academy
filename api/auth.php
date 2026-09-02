<?php
session_start();
require_once __DIR__ . '/includes/Database.php';
require_once __DIR__ . '/includes/User.php';

// CORS headers
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Credentials: true');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

header('Content-Type: application/json');

try {
    $user = new User();
    $method = $_SERVER['REQUEST_METHOD'];
    $action = $_GET['action'] ?? '';

    switch ($method) {
        case 'POST':
            $data = json_decode(file_get_contents('php://input'), true);

            switch ($action) {
                case 'login':
                    if (!isset($data['username']) || !isset($data['password'])) {
                        throw new Exception('Не указано имя пользователя или пароль');
                    }

                    $result = $user->authenticate($data['username'], $data['password']);
                    if ($result) {
                        $_SESSION['user_id'] = $result['id'];
                        $_SESSION['username'] = $result['username'];
                    }
                    break;

                case 'register':
                    if (!isset($data['username']) || !isset($data['password'])) {
                        throw new Exception('Не указаны все необходимые данные');
                    }

                    $result = $user->create($data['username'], $data['password']);
                    break;

                default:
                    throw new Exception('Неизвестное действие');
            }
            break;

        case 'GET':
            switch ($action) {
                case 'check':
                    $result = [
                        'authenticated' => isset($_SESSION['user_id']),
                        'user' => isset($_SESSION['user_id']) ? [
                            'id' => $_SESSION['user_id'],
                            'username' => $_SESSION['username']
                        ] : null
                    ];
                    break;

                default:
                    throw new Exception('Неизвестное действие');
            }
            break;

        case 'DELETE':
            if ($action === 'logout') {
                @session_destroy();
                $result = ['success' => true];
            } else {
                throw new Exception('Неизвестное действие');
            }
            break;

        default:
            throw new Exception('Метод не поддерживается');
    }

    echo json_encode(['success' => true, 'data' => $result]);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
} 