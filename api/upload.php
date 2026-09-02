<?php
require_once __DIR__ . '/includes/Database.php';
require_once __DIR__ . '/includes/Media.php';

header('Content-Type: application/json');

try {
    $media = new Media();
    
    if (!isset($_FILES['upload'])) {
        throw new Exception('Файл не был загружен');
    }

    $result = $media->upload($_FILES['upload']);
    echo json_encode(['success' => true, 'url' => $result['path']]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
} 