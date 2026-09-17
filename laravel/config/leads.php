<?php

/*
 | Каналы, куда уходят заявки с сайта.
 | Пока значения пустые — заявки только пишутся в лог.
 | Заполняются в .env.
 */

return [
    'telegram' => [
        /* Пока сайт не подключён к CRM, уведомления идут в Telegram.
           Когда заявки начнут падать в CRM, строку TELEGRAM_LEADS_ENABLED=false
           в .env достаточно поставить — и уведомления выключатся. */
        'enabled' => (bool) env('TELEGRAM_LEADS_ENABLED', true),
        'token'   => env('TELEGRAM_BOT_TOKEN'),
        'chat_id' => env('TELEGRAM_CHAT_ID'),
    ],

    'bitrix' => [
        // Входящий вебхук вида https://портал.bitrix24.ru/rest/1/xxxxxxxx
        'webhook'     => env('BITRIX_WEBHOOK'),
        'assigned_to' => env('BITRIX_ASSIGNED_TO'),
    ],
];
