<?php
require_once __DIR__ . '/includes/Database.php';
require_once __DIR__ . '/includes/Media.php';

header('Content-Type: application/json');

try {
    $media = new Media();
    $method = $_SERVER['REQUEST_METHOD'];
    $id = $_GET['id'] ?? null;

    switch ($method) {
        case 'POST':
            if (!isset($_FILES['file'])) {
                throw new Exception('Файл не был загружен');
            }

            $result = $media->upload($_FILES['file']);
            break;

        case 'DELETE':
            if (!$id) {
                throw new Exception('ID не указан');
            }
            $result = ['success' => $media->delete((int)$id)];
            break;

        default:
            throw new Exception('Метод не поддерживается');
    }

    echo json_encode(['success' => true, 'data' => $result]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
} 