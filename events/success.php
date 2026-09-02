<?php require_once __DIR__ . '/config.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Подтверждение записи</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; color: #333; }
        .container { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; }
        h1 { color: #8B4513; margin-bottom: 20px; }
        .address { font-size: 18px; margin: 20px 0; color: #555; }
        @media (max-width: 768px) { .container { padding: 20px; } }
    </style>
</head>
<body>
    <div class="container">
        <h1>Запись подтверждена!</h1>
        <p>Вы успешно зарегистрированы на <?php echo htmlspecialchars($_GET['date'] ?? 'выбранную дату'); ?> в 13:00.</p>
        <div class="address">
            <strong>Адрес мероприятия:</strong><br>
            Крокус Экспо, 65–66 км МКАД<br>
            Станция «Мякинино», павильон №3, зал 13, стенд 1F106
        </div>
    </div>
</body>
</html>
