<?php

class Category {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function create(array $data): int {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO categories (name)
                VALUES (:name)
            ");

            $stmt->execute([
                'name' => $data['name']
            ]);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // Ошибка дублирования уникального ключа
                throw new Exception('Категория с таким slug уже существует');
            }
            throw new Exception("Ошибка при создании категории: " . $e->getMessage());
        }
    }
    public function delete(int $id): bool {
        try {
            // Проверяем, есть ли статьи в этой категории
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM articles WHERE category_id = ?");
            $stmt->execute([$id]);
            if ($stmt->fetchColumn() > 0) {
                throw new Exception('Невозможно удалить категорию, содержащую статьи');
            }

            $stmt = $this->db->prepare("DELETE FROM categories WHERE id = ?");
            $stmt->execute([$id]);
            return true;
        } catch (Exception $e) {
            throw new Exception("Ошибка при удалении категории: " . $e->getMessage());
        }
    }
    public function getAll(): array {
        $stmt = $this->db->prepare("
            SELECT c.*, COUNT(a.id) as articles_count
            FROM categories c
            LEFT JOIN articles a ON c.id = a.category_id
            GROUP BY c.id
            ORDER BY c.name ASC
        ");

        $stmt->execute();
        return $stmt->fetchAll();
    }
} 