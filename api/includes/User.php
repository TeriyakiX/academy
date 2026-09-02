<?php

class User {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function create(string $username, string $password): array {
        // Проверяем, существует ли пользователь
        $stmt = $this->db->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        
        if ($stmt->fetch()) {
            throw new Exception('Пользователь с таким именем уже существует');
        }

        // Хешируем пароль
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Создаем пользователя
        $stmt = $this->db->prepare("
            INSERT INTO users (username, password, created_at)
            VALUES (?, ?, NOW())
        ");

        $stmt->execute([$username, $hashedPassword]);
        $userId = $this->db->lastInsertId();

        return $this->getById($userId);
    }

    public function authenticate(string $username, string $password): array {
        $stmt = $this->db->prepare("
            SELECT * FROM users 
            WHERE username = ?
        ");
        
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if (!$user || !password_verify($password, $user['password'])) {
            throw new Exception('Неверное имя пользователя или пароль');
        }

        // Создаем сессию
        @session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        return $this->getById($user['id']);
    }

    public function logout(): void {
        @session_start();
        session_destroy();
    }

    public function getById(int $id): array {
        $stmt = $this->db->prepare("
            SELECT id, username, created_at 
            FROM users 
            WHERE id = ?
        ");
        
        $stmt->execute([$id]);
        $user = $stmt->fetch();

        if (!$user) {
            throw new Exception('Пользователь не найден');
        }

        return $user;
    }

    public function isAuthenticated(): bool {
        @session_start();
        return isset($_SESSION['user_id']);
    }

    public function getCurrentUser(): ?array {
        if (!$this->isAuthenticated()) {
            return null;
        }

        return $this->getById($_SESSION['user_id']);
    }

    public function updatePassword(int $userId, string $currentPassword, string $newPassword): bool {
        // Получаем текущий пароль
        $stmt = $this->db->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch();

        if (!$user || !password_verify($currentPassword, $user['password'])) {
            throw new Exception('Неверный текущий пароль');
        }

        // Обновляем пароль
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("UPDATE users SET password = ? WHERE id = ?");
        
        return $stmt->execute([$hashedPassword, $userId]);
    }
} 