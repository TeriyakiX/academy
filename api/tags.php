<?php
require_once __DIR__ . '/includes/Database.php';
require_once __DIR__ . '/includes/Tag.php';

header('Content-Type: application/json');

try {
    $tag = new Tag();
    $method = $_SERVER['REQUEST_METHOD'];
    $id = $_GET['id'] ?? null;
    $query = $_GET['query'] ?? null;

    switch ($method) {
        case 'GET':
            if ($id) {
                $result = $tag->getById((int)$id);
            } elseif ($query) {
                $result = $tag->search($query);
            } else {
                $result = $tag->getAll();
            }
            break;

        case 'POST':
            $data = json_decode(file_get_contents('php://input'), true);
            if (!$data) {
                throw new Exception('Неверный формат данных');
            }
            if (empty($data['name'])) {
                throw new Exception('Название тега обязательно');
            }
            if (empty($data['slug'])) {
                $data['slug'] = $tag->generateSlug($data['name']);
            }
            $result = ['id' => $tag->create($data)];
            break;

        case 'PUT':
            if (!$id) {
                throw new Exception('ID не указан');
            }
            $data = json_decode(file_get_contents('php://input'), true);
            if (!$data) {
                throw new Exception('Неверный формат данных');
            }
            if (empty($data['name'])) {
                throw new Exception('Название тега обязательно');
            }
            if (empty($data['slug'])) {
                $data['slug'] = $tag->generateSlug($data['name']);
            }
            $result = ['success' => $tag->update((int)$id, $data)];
            break;

        case 'DELETE':
            if (!$id) {
                throw new Exception('ID не указан');
            }
            $result = ['success' => $tag->delete((int)$id)];
            break;

        default:
            throw new Exception('Метод не поддерживается');
    }

    echo json_encode(['success' => true, 'data' => $result]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
} 