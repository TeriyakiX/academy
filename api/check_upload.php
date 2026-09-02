<?php
header('Content-Type: application/json');

$settings = [
    'upload_max_filesize' => ini_get('upload_max_filesize'),
    'post_max_size' => ini_get('post_max_size'),
    'max_file_uploads' => ini_get('max_file_uploads'),
    'upload_tmp_dir' => ini_get('upload_tmp_dir'),
    'upload_dir_writable' => is_writable(__DIR__ . '/../uploads/images/'),
    'upload_dir_exists' => file_exists(__DIR__ . '/../uploads/images/'),
    'upload_dir_path' => realpath(__DIR__ . '/../uploads/images/'),
    'php_version' => PHP_VERSION,
    'server_software' => $_SERVER['SERVER_SOFTWARE']
];

echo json_encode($settings, JSON_PRETTY_PRINT); 