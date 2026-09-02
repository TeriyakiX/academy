<?php

class Media {
    private PDO $db;
    private string $uploadDir;
    private array $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    private int $maxFileSize = 5242880; // 5MB

    public function __construct() {
        $this->db = Database::getInstance();
        $this->uploadDir = __DIR__ . '/../../uploads/';
        
        if (!file_exists($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }

    public function upload(array $file): array {
        if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
            throw new Exception('Файл не был загружен');
        }

        if (!in_array($file['type'], $this->allowedTypes)) {
            throw new Exception('Неподдерживаемый тип файла');
        }

        if ($file['size'] > $this->maxFileSize) {
            throw new Exception('Размер файла превышает допустимый');
        }

        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $extension;
        $filepath = $this->uploadDir . $filename;

        if (!move_uploaded_file($file['tmp_name'], $filepath)) {
            throw new Exception('Ошибка при сохранении файла');
        }

        return [
            'path' => '/uploads/' . $filename,
            'type' => $file['type']
        ];
    }

    public function delete(int $id): bool {
        try {
            // Получаем информацию о файле
            $stmt = $this->db->prepare("SELECT file_path FROM article_media WHERE id = ?");
            $stmt->execute([$id]);
            $media = $stmt->fetch();

            if (!$media) {
                throw new Exception('Медиафайл не найден');
            }

            // Удаляем файл с диска
            $filepath = __DIR__ . '/../' . $media['file_path'];
            if (file_exists($filepath)) {
                unlink($filepath);
            }

            // Удаляем запись из базы данных
            $stmt = $this->db->prepare("DELETE FROM article_media WHERE id = ?");
            $stmt->execute([$id]);

            return true;
        } catch (Exception $e) {
            throw new Exception("Ошибка при удалении медиафайла: " . $e->getMessage());
        }
    }

    public function getByArticleId(int $articleId): array {
        $stmt = $this->db->prepare("
            SELECT * FROM article_media
            WHERE article_id = ?
            ORDER BY created_at DESC
        ");

        $stmt->execute([$articleId]);
        return $stmt->fetchAll();
    }

    public function validateImage(string $filepath): bool {
        $imageInfo = getimagesize($filepath);
        if ($imageInfo === false) {
            return false;
        }

        // Проверяем размеры изображения
        $maxWidth = 1920;
        $maxHeight = 1080;

        if ($imageInfo[0] > $maxWidth || $imageInfo[1] > $maxHeight) {
            // Создаем новое изображение с правильными размерами
            $sourceImage = imagecreatefromstring(file_get_contents($filepath));
            $width = $imageInfo[0];
            $height = $imageInfo[1];

            if ($width > $height) {
                $newWidth = $maxWidth;
                $newHeight = floor($height * ($maxWidth / $width));
            } else {
                $newHeight = $maxHeight;
                $newWidth = floor($width * ($maxHeight / $height));
            }

            $newImage = imagecreatetruecolor($newWidth, $newHeight);
            
            // Сохраняем прозрачность для PNG
            if ($imageInfo[2] === IMAGETYPE_PNG) {
                imagealphablending($newImage, false);
                imagesavealpha($newImage, true);
            }

            imagecopyresampled(
                $newImage, $sourceImage,
                0, 0, 0, 0,
                $newWidth, $newHeight,
                $width, $height
            );

            // Сохраняем изображение
            switch ($imageInfo[2]) {
                case IMAGETYPE_JPEG:
                    imagejpeg($newImage, $filepath, 90);
                    break;
                case IMAGETYPE_PNG:
                    imagepng($newImage, $filepath, 9);
                    break;
                case IMAGETYPE_GIF:
                    imagegif($newImage, $filepath);
                    break;
                case IMAGETYPE_WEBP:
                    imagewebp($newImage, $filepath, 90);
                    break;
            }

            imagedestroy($sourceImage);
            imagedestroy($newImage);
        }

        return true;
    }
} 