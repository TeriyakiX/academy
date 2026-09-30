<?php

/*
 | Единый источник навигации, контактов и соцсетей.
 | Раньше меню было скопировано в 29 файлов и разошлось на 5 разных версий —
 | теперь правится только здесь.
 */

return [
    'contacts' => [
        'phone'      => '+7 (925) 152-28-66',
        'phone_href' => 'tel:+79251522866',
        'email'      => 'consulting@academy-barista.ru',
        'address'    => 'г. Москва, Фридриха Энгельса, 25с7',
        'hours'      => 'Пн-Вс 10:00 – 20:00',
    ],

    'socials' => [
        ['title' => 'Telegram', 'href' => 'https://t.me/academybarista',     'icon' => 'telegram'],
        ['title' => 'WhatsApp', 'href' => 'https://wa.me/79251522866',       'icon' => 'whatsapp'],
        ['title' => 'ВКонтакте','href' => 'https://vk.com/academybarista1',  'icon' => 'vk'],
        ['title' => 'YouTube',  'href' => 'https://youtube.com/@academybarista', 'icon' => 'youtube'],
        ['title' => 'Max',      'href' => 'https://max.ru/id9721113617_biz', 'icon' => 'max'],
    ],

    // Главное меню. children => выпадающий список.
    'main' => [
        // Списки программ подставляются из каталога: App\Support\Navigation.
        ['title' => 'Курсы бариста', 'href' => '/courses.html', 'school' => 'Курсы бариста'],
        ['title' => 'Мастер-классы', 'href' => '/courses/master-class.html', 'school' => 'Мастер-классы'],
        ['title' => 'Барное дело',   'href' => '/courses/barnoe-delo.html', 'school' => 'Барное дело'],
        ['title' => 'Собрать свой курс', 'href' => '/constructor.html'],
        ['title' => 'Для бизнеса',       'href' => '/busines.html', 'accent' => true],
        ['title' => 'Сервис',            'href' => '/service.html'],
        ['title' => 'Оборудование',     'href' => '/shop.html'],
        ['title' => 'Сертификат',        'href' => '/sertifikat.html'],
        ['title' => 'Мероприятия',       'href' => '/events.html'],
        ['title' => 'О нас',             'href' => '/o-nas.html'],
        ['title' => 'Блог',              'href' => '/blog.html'],
        ['title' => 'Контакты',          'href' => '/contact.html'],
    ],

    // Колонки подвала
    'footer' => [
        'Навигация' => [
            ['title' => 'Главная',     'href' => '/'],
            ['title' => 'Курсы',       'href' => '/courses.html'],
            ['title' => 'Конструктор', 'href' => '/constructor.html'],
            ['title' => 'Сертификат',  'href' => '/sertifikat.html'],
            ['title' => 'Для бизнеса', 'href' => '/busines.html'],
            ['title' => 'Сервис',      'href' => '/service.html'],
            ['title' => 'Оборудование','href' => '/shop.html'],
            ['title' => 'Мероприятия', 'href' => '/events.html'],
            ['title' => 'О нас',       'href' => '/o-nas.html'],
            ['title' => 'Блог',        'href' => '/blog.html'],
            ['title' => 'Контакты',    'href' => '/contact.html'],
        ],
        // Те же списки, что и в шапке: собираются из каталога.
        'Курсы бариста' => 'Курсы бариста',
        'Мастер-классы' => 'Мастер-классы',
        'Барное дело'   => 'Барное дело',
    ],

    'legal' => [
        ['title' => 'Политика конфиденциальности', 'href' => '/privacy-policy.html'],
        ['title' => 'Договор-оферта',              'href' => '/oferta.html'],
        ['title' => 'Согласие на обработку данных','href' => '/user-agreement.html'],
    ],
];
