<?php

class Tag {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function create(array $data): int {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO tags (name, slug)
                VALUES (:name, :slug)
            ");

            $stmt->execute([
                'name' => $data['name'],
                'slug' => $data['slug']
            ]);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                throw new Exception('Тег с таким slug уже существует');
            }
            throw new Exception("Ошибка при создании тега: " . $e->getMessage());
        }
    }

    public function update(int $id, array $data): bool {
        try {
            $stmt = $this->db->prepare("
                UPDATE tags 
                SET name = :name,
                    slug = :slug
                WHERE id = :id
            ");

            $stmt->execute([
                'id' => $id,
                'name' => $data['name'],
                'slug' => $data['slug']
            ]);

            return true;
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                throw new Exception('Тег с таким slug уже существует');
            }
            throw new Exception("Ошибка при обновлении тега: " . $e->getMessage());
        }
    }

    public function delete(int $id): bool {
        try {
            // Проверяем, используется ли тег в статьях
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM article_tags WHERE tag_id = ?");
            $stmt->execute([$id]);
            if ($stmt->fetchColumn() > 0) {
                throw new Exception('Невозможно удалить тег, который используется в статьях');
            }

            $stmt = $this->db->prepare("DELETE FROM tags WHERE id = ?");
            $stmt->execute([$id]);
            return true;
        } catch (Exception $e) {
            throw new Exception("Ошибка при удалении тега: " . $e->getMessage());
        }
    }

    public function getById(int $id): ?array {
        $stmt = $this->db->prepare("
            SELECT t.*, COUNT(at.article_id) as articles_count
            FROM tags t
            LEFT JOIN article_tags at ON t.id = at.tag_id
            WHERE t.id = ?
            GROUP BY t.id
        ");

        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function getAll(): array {
        $stmt = $this->db->prepare("
            SELECT t.*, COUNT(at.article_id) as articles_count
            FROM tags t
            LEFT JOIN article_tags at ON t.id = at.tag_id
            GROUP BY t.id
            ORDER BY t.name ASC
        ");

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByArticleId(int $articleId): array {
        $stmt = $this->db->prepare("
            SELECT t.*
            FROM tags t
            JOIN article_tags at ON t.id = at.tag_id
            WHERE at.article_id = ?
            ORDER BY t.name ASC
        ");

        $stmt->execute([$articleId]);
        return $stmt->fetchAll();
    }

    public function generateSlug(string $name): string {
        $slug = mb_strtolower($name);
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        $slug = trim($slug, '-');

        // Проверяем уникальность slug
        $baseSlug = $slug;
        $counter = 1;
        
        while (true) {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM tags WHERE slug = ?");
            $stmt->execute([$slug]);
            if ($stmt->fetchColumn() == 0) {
                break;
            }
            $slug = $baseSlug . '-' . $counter++;
        }

        return $slug;
    }

    public function search(string $query): array {
        $stmt = $this->db->prepare("
            SELECT t.*, COUNT(at.article_id) as articles_count
            FROM tags t
            LEFT JOIN article_tags at ON t.id = at.tag_id
            WHERE t.name LIKE :query
            GROUP BY t.id
            ORDER BY t.name ASC
            LIMIT 10
        ");

        $stmt->execute(['query' => "%$query%"]);
        return $stmt->fetchAll();
    }
} 