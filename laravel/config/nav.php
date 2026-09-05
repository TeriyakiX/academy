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
        ['title' => 'Курсы бариста', 'href' => '/courses.html', 'children' => [
            ['title' => 'Бариста базовый',      'href' => '/courses/barista-base.html'],
            ['title' => 'Бариста продвинутый',  'href' => '/courses/barista-advanced.html'],
            ['title' => 'Бариста техник',       'href' => '/courses/barista-technician.html'],
            ['title' => 'Бариста Professional', 'href' => '/courses/barista-professional.html'],
            ['title' => 'Управляющий кофейни',  'href' => '/courses/upravlyayushchiy-kofeyni.html'],
        ]],
        ['title' => 'Мастер-классы', 'href' => '/courses/master-class.html', 'children' => [
            ['title' => 'Латте-арт',         'href' => '/master-class/latte-art.html'],
            ['title' => 'Юный бариста',      'href' => '/master-class/young-barista.html'],
            ['title' => 'Домашняя кофейня',  'href' => '/master-class/domashnyaya-kofeynya.html'],
            ['title' => 'Бариста в Take Away','href' => '/master-class/barista-v-take-away.html'],
            ['title' => 'Домашний бариста',  'href' => '/master-class/domashniy-barista.html'],
        ]],
        ['title' => 'Барное дело', 'href' => '/courses/barnoe-delo.html', 'children' => [
            ['title' => 'Вкус и стиль: метод Стир',  'href' => '/barnoe-delo/metod-ctir.html'],
            ['title' => 'Коктейль методом Билд',     'href' => '/barnoe-delo/koktel-metodom-bild.html'],
            ['title' => 'Встряхни и подай',          'href' => '/barnoe-delo/vstryakhni-i-poday.html'],
        ]],
        ['title' => 'Собрать свой курс', 'href' => '/constructor.html'],
        ['title' => 'Для бизнеса',       'href' => '/busines.html', 'accent' => true],
        ['title' => 'Оборудование',     'href' => '/shop.html'],
        ['title' => 'Сертификат',        'href' => '/sertifikat.html'],
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
            ['title' => 'Оборудование','href' => '/shop.html'],
            ['title' => 'Мероприятия', 'href' => '/events.html'],
            ['title' => 'Блог',        'href' => '/blog.html'],
            ['title' => 'Контакты',    'href' => '/contact.html'],
        ],
        'Курсы бариста' => [
            ['title' => 'Бариста базовый',      'href' => '/courses/barista-base.html'],
            ['title' => 'Бариста продвинутый',  'href' => '/courses/barista-advanced.html'],
            ['title' => 'Бариста техник',       'href' => '/courses/barista-technician.html'],
            ['title' => 'Бариста Professional', 'href' => '/courses/barista-professional.html'],
            ['title' => 'Управляющий кофейни',  'href' => '/courses/upravlyayushchiy-kofeyni.html'],
        ],
        'Мастер-классы' => [
            ['title' => 'Латте-арт',           'href' => '/master-class/latte-art.html'],
            ['title' => 'Юный бариста',        'href' => '/master-class/young-barista.html'],
            ['title' => 'Домашняя кофейня',    'href' => '/master-class/domashnyaya-kofeynya.html'],
            ['title' => 'Бариста в Take Away', 'href' => '/master-class/barista-v-take-away.html'],
            ['title' => 'Домашний бариста',    'href' => '/master-class/domashniy-barista.html'],
        ],
        'Барное дело' => [
            ['title' => 'Вкус и стиль: метод Стир', 'href' => '/barnoe-delo/metod-ctir.html'],
            ['title' => 'Коктейль методом Билд',    'href' => '/barnoe-delo/koktel-metodom-bild.html'],
            ['title' => 'Встряхни и подай',         'href' => '/barnoe-delo/vstryakhni-i-poday.html'],
        ],
    ],

    'legal' => [
        ['title' => 'Политика конфиденциальности', 'href' => '/privacy-policy.html'],
        ['title' => 'Договор-оферта',              'href' => '/oferta.html'],
        ['title' => 'Согласие на обработку данных','href' => '/user-agreement.html'],
    ],
];
