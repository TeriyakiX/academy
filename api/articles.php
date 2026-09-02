<?php
require_once __DIR__ . '/includes/Database.php';
require_once __DIR__ . '/includes/Article.php';

header('Content-Type: application/json');

try {
    $article = new Article();
    $method = $_SERVER['REQUEST_METHOD'];
    $id = $_GET['id'] ?? null;

    switch ($method) {
        case 'GET':
            if ($id) {
                $result = $article->getById((int)$id);
            } else {
                $filters = [
                    'category_id' => $_GET['category_id'] ?? null,
                    'tag_id' => $_GET['tag_id'] ?? null,
                    'sort' => $_GET['sort'] ?? 'date_desc'
                ];
                $result = $article->getAll($filters);
            }
            break;

        case 'POST':
            $data = json_decode(file_get_contents('php://input'), true);
            if (!$data) {
                throw new Exception('Неверный формат данных');
            }
            $result = ['id' => $article->create($data)];
            break;

        case 'PUT':
            if (!$id) {
                throw new Exception('ID не указан');
            }
            
            // Получаем данные из FormData или JSON
            $data = [];
            if (strpos($_SERVER['CONTENT_TYPE'], 'multipart/form-data') !== false) {
                $data = $_POST;
                // Обрабатываем JSON строки в FormData
                if (isset($data['tags'])) {
                    $data['tags'] = json_decode($data['tags'], true);
                }
                if (isset($data['media'])) {
                    $data['media'] = json_decode($data['media'], true);
                }
            } else {
                $data = json_decode(file_get_contents('php://input'), true);
            }
            
            if (!$data) {
                throw new Exception('Неверный формат данных');
            }
            
            $result = ['success' => $article->update((int)$id, $data)];
            break;

        case 'DELETE':
            if (!$id) {
                throw new Exception('ID не указан');
            }
            $result = ['success' => $article->delete((int)$id)];
            break;

        default:
            throw new Exception('Метод не поддерживается');
    }

    echo json_encode(['success' => true, 'data' => $result]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
} 