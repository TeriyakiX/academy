<?php
require_once __DIR__ . '/includes/Database.php';
require_once __DIR__ . '/includes/Category.php';

header('Content-Type: application/json');

try {
    $category = new Category();
    $method = $_SERVER['REQUEST_METHOD'];
    $id = $_GET['id'] ?? null;

    switch ($method) {
        case 'GET':
            $result = $category->getAll();
            break;

        case 'POST':
            $data = json_decode(file_get_contents('php://input'), true);
            if (!$data) {
                throw new Exception('Неверный формат данных');
            }
            if (empty($data['name'])) {
                throw new Exception('Название категории обязательно');
            }
            $result = ['id' => $category->create($data)];
            break;

        case 'DELETE':
            if (!$id) {
                throw new Exception('ID не указан');
            }
            $result = ['success' => $category->delete((int)$id)];
            break;

        default:
            throw new Exception('Метод не поддерживается');
    }

    echo json_encode(['success' => true, 'data' => $result]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
} 