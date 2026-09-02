<?php

class Article {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function create(array $data): int {
        try {
            $this->db->beginTransaction();

            // Создаем статью
            $stmt = $this->db->prepare("
                INSERT INTO articles (title, img, content, category_id, created_at, updated_at)
                VALUES (:title, :img, :content, :category_id, NOW(), NOW())
            ");

            $stmt->execute([
                'title' => $data['title'],
                'img' => $data['img'],
                'content' => $data['content'],
                'category_id' => $data['category_id']
            ]);

            $articleId = $this->db->lastInsertId();

            // Добавляем теги
            if (!empty($data['tags'])) {
                error_log('Tags data: ' . print_r($data['tags'], true));
                error_log('Tag names: ' . print_r($data['tag_names'] ?? [], true));

                // Сначала создаем новые теги
                $newTagIds = [];
                foreach ($data['tags'] as $tag) {
                    error_log('Processing tag: ' . print_r($tag, true));
                    if (is_string($tag) && strpos($tag, 'temp_') === 0) {
                        // Получаем имя тега из массива tag_names
                        $tagName = isset($data['tag_names'][$tag]) ? $data['tag_names'][$tag] : null;
                        error_log('New tag name: ' . $tagName);
                        if ($tagName) {
                            $tagStmt = $this->db->prepare("
                                INSERT INTO tags (name, created_at)
                                VALUES (:name, NOW())
                            ");
                            $tagStmt->execute(['name' => $tagName]);
                            $newTagIds[$tag] = $this->db->lastInsertId();
                            error_log('Created new tag with ID: ' . $newTagIds[$tag]);
                        }
                    }
                }

                error_log('New tag IDs: ' . print_r($newTagIds, true));

                // Теперь связываем все теги со статьей
                $stmt = $this->db->prepare("
                    INSERT INTO article_tags (article_id, tag_id)
                    VALUES (:article_id, :tag_id)
                ");

                foreach ($data['tags'] as $tag) {
                    $tagId = is_string($tag) && strpos($tag, 'temp_') === 0 
                        ? ($newTagIds[$tag] ?? null)
                        : $tag;

                    error_log('Linking tag ID: ' . $tagId . ' to article: ' . $articleId);

                    if ($tagId) {
                        $stmt->execute([
                            'article_id' => $articleId,
                            'tag_id' => $tagId
                        ]);
                    }
                }
            }

            // Сохраняем медиафайлы из редактора
            if (!empty($data['media'])) {
                $stmt = $this->db->prepare("
                    INSERT INTO article_media (article_id, file_path, file_type, created_at)
                    VALUES (:article_id, :file_path, :file_type, NOW())
                ");

                foreach ($data['media'] as $media) {
                    $stmt->execute([
                        'article_id' => $articleId,
                        'file_path' => $media['path'],
                        'file_type' => $media['type']
                    ]);
                }
            }

            $this->db->commit();
            return $articleId;

        } catch (Exception $e) {
            $this->db->rollBack();
            throw new Exception("Ошибка при создании статьи: " . $e->getMessage());
        }
    }

    public function update(int $id, array $data): bool {
        try {
            $this->db->beginTransaction();

            if(isset($data['img'])) {
                // Обновляем статью
                $stmt = $this->db->prepare("
                UPDATE articles 
                SET title = :title,
                    img = :img,
                    content = :content,
                    category_id = :category_id,
                    updated_at = NOW()
                WHERE id = :id
            ");

                $stmt->execute([
                    'id' => $id,
                    'title' => $data['title'],
                    'img' => $data['img'] ?? null,
                    'content' => $data['content'],
                    'category_id' => $data['category_id']
                ]);
            }else{
                // Обновляем статью
                $stmt = $this->db->prepare("
                UPDATE articles 
                SET title = :title,
                    content = :content,
                    category_id = :category_id,
                    updated_at = NOW()
                WHERE id = :id
            ");

                $stmt->execute([
                    'id' => $id,
                    'title' => $data['title'],
                    'content' => $data['content'],
                    'category_id' => $data['category_id']
                ]);
            }

            // Обновляем теги
            $this->db->prepare("DELETE FROM article_tags WHERE article_id = ?")->execute([$id]);

            if (!empty($data['tags'])) {
                error_log('Update - Tags data: ' . print_r($data['tags'], true));
                error_log('Update - Tag names: ' . print_r($data['tag_names'] ?? [], true));

                // Сначала создаем новые теги
                $newTagIds = [];
                foreach ($data['tags'] as $tag) {
                    error_log('Update - Processing tag: ' . print_r($tag, true));
                    if (is_string($tag) && strpos($tag, 'temp_') === 0) {
                        // Получаем имя тега из массива tag_names
                        $tagName = isset($data['tag_names'][$tag]) ? $data['tag_names'][$tag] : null;
                        error_log('Update - New tag name: ' . $tagName);
                        if ($tagName) {
                            $tagStmt = $this->db->prepare("
                                INSERT INTO tags (name, created_at)
                                VALUES (:name, NOW())
                            ");
                            $tagStmt->execute(['name' => $tagName]);
                            $newTagIds[$tag] = $this->db->lastInsertId();
                            error_log('Update - Created new tag with ID: ' . $newTagIds[$tag]);
                        }
                    }
                }

                error_log('Update - New tag IDs: ' . print_r($newTagIds, true));

                // Теперь связываем все теги со статьей
                $stmt = $this->db->prepare("
                    INSERT INTO article_tags (article_id, tag_id)
                    VALUES (:article_id, :tag_id)
                ");

                foreach ($data['tags'] as $tag) {
                    $tagId = is_string($tag) && strpos($tag, 'temp_') === 0 
                        ? ($newTagIds[$tag] ?? null)
                        : $tag;

                    error_log('Update - Linking tag ID: ' . $tagId . ' to article: ' . $id);

                    if ($tagId) {
                        $stmt->execute([
                            'article_id' => $id,
                            'tag_id' => $tagId
                        ]);
                    }
                }
            }

            // Обновляем медиафайлы из редактора
            if (!empty($data['media'])) {
                // Удаляем старые медиафайлы
                $this->db->prepare("DELETE FROM article_media WHERE article_id = ?")->execute([$id]);

                $stmt = $this->db->prepare("
                    INSERT INTO article_media (article_id, file_path, file_type, created_at)
                    VALUES (:article_id, :file_path, :file_type, NOW())
                ");

                foreach ($data['media'] as $media) {
                    $stmt->execute([
                        'article_id' => $id,
                        'file_path' => $media['path'],
                        'file_type' => $media['type']
                    ]);
                }
            }

            $this->db->commit();
            return true;

        } catch (Exception $e) {
            $this->db->rollBack();
            throw new Exception("Ошибка при обновлении статьи: " . $e->getMessage());
        }
    }

    public function delete(int $id): bool {
        try {
            $this->db->beginTransaction();

            // Удаляем связанные записи
            $this->db->prepare("DELETE FROM article_tags WHERE article_id = ?")->execute([$id]);
            $this->db->prepare("DELETE FROM article_media WHERE article_id = ?")->execute([$id]);
            
            // Удаляем статью
            $stmt = $this->db->prepare("DELETE FROM articles WHERE id = ?");
            $stmt->execute([$id]);

            $this->db->commit();
            return true;

        } catch (Exception $e) {
            $this->db->rollBack();
            throw new Exception("Ошибка при удалении статьи: " . $e->getMessage());
        }
    }

    public function getById(int $id): ?array {
        $stmt = $this->db->prepare("
            SELECT a.*, c.name as category_name,
                   GROUP_CONCAT(t.id) as tag_ids,
                   GROUP_CONCAT(t.name) as tag_names
            FROM articles a
            LEFT JOIN categories c ON a.category_id = c.id
            LEFT JOIN article_tags at ON a.id = at.article_id
            LEFT JOIN tags t ON at.tag_id = t.id
            WHERE a.id = ?
            GROUP BY a.id
        ");

        $stmt->execute([$id]);
        $article = $stmt->fetch();

        if ($article) {
            $article['tag_ids'] = $article['tag_ids'] ? explode(',', $article['tag_ids']) : [];
            $article['tag_names'] = $article['tag_names'] ? explode(',', $article['tag_names']) : [];
            
            // Получаем медиафайлы
            $stmt = $this->db->prepare("SELECT * FROM article_media WHERE article_id = ?");
            $stmt->execute([$id]);
            $article['media'] = $stmt->fetchAll();
        }

        return $article ?: null;
    }

    public function getAll(array $filters = []): array {
        $where = [];
        $params = [];

        if (!empty($filters['category_id'])) {
            $where[] = "a.category_id = :category_id";
            $params['category_id'] = $filters['category_id'];
        }

        if (!empty($filters['tag_id'])) {
            $where[] = "at.tag_id = :tag_id";
            $params['tag_id'] = $filters['tag_id'];
        }

        $whereClause = $where ? "WHERE " . implode(" AND ", $where) : "";

        $orderBy = match($filters['sort'] ?? 'date_desc') {
            'date_asc' => 'a.created_at ASC',
            'title_asc' => 'a.title ASC',
            'title_desc' => 'a.title DESC',
            default => 'a.created_at DESC'
        };

        $sql = "
            SELECT a.*, c.name as category_name,
                   GROUP_CONCAT(t.id) as tag_ids,
                   GROUP_CONCAT(t.name) as tag_names
            FROM articles a
            LEFT JOIN categories c ON a.category_id = c.id
            LEFT JOIN article_tags at ON a.id = at.article_id
            LEFT JOIN tags t ON at.tag_id = t.id
            $whereClause
            GROUP BY a.id
            ORDER BY $orderBy
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $articles = $stmt->fetchAll();

        foreach ($articles as &$article) {
            $article['tag_ids'] = $article['tag_ids'] ? explode(',', $article['tag_ids']) : [];
            $article['tag_names'] = $article['tag_names'] ? explode(',', $article['tag_names']) : [];
            
            // Получаем медиафайлы для каждой статьи
            $stmt = $this->db->prepare("SELECT * FROM article_media WHERE article_id = ?");
            $stmt->execute([$article['id']]);
            $article['media'] = $stmt->fetchAll();
        }

        return $articles;
    }
} 