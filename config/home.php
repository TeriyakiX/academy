<?php

/*
 | Данные блоков главной страницы.
 |
 | ВАЖНО про заглушки: поля, помеченные 'demo' => true, содержат
 | предварительные данные и требуют подтверждения заказчика.
 */

return [

    /* ---------- Первый экран ---------- */
    'hero' => [
        // Заголовок и текст сохранены по смыслу — они участвуют в поисковой выдаче.
        'title' => 'Станьте востребованным бариста с доходом от 60.000 ₽ в Москве',
        // Та же строка с выделением суммы. Текст не меняется — только акцент.
        'title_html' => 'Станьте востребованным бариста с доходом <em>от 60.000 ₽</em> в Москве',
        'text'  => 'Курсы бариста в Москве для любого уровня подготовки. Обучение для тех, кто планирует карьеру в индустрии, поддержка при открытии кофейного бизнеса и мастер-классы для любителей кофе.',

        // Направления первого экрана. Фото и ссылки — из прежней версии сайта.
        'directions' => [
            [
                'title' => 'Курсы для бариста',
                'short' => 'Бариста',
                'text'  => 'Обучение для карьеры, бизнеса и любителей кофе. 90% практики на топовом оборудовании, сертификат в конце обучения.',
                'photo' => '/assets/barista.webp',
                'href'  => '/courses/barista-courses.html',
                'link'  => 'Перейти к курсам бариста',
            ],
            [
                'title' => 'Мастер-классы',
                'short' => 'Мастер-классы',
                'text'  => 'Идеальный формат для тех, кто хочет научиться варить кофе как профи у себя дома или освоить базу латте-арта.',
                'photo' => '/assets/master-class.webp',
                'href'  => '/courses/master-class.html',
                'link'  => 'Перейти к мастер-классам',
            ],
            [
                'title' => 'Курсы для барменов',
                'short' => 'Барменам',
                'text'  => 'Освойте базовые методы приготовления коктейлей: билд, стир, шейк. Научим соблюдать баланс вкуса и красиво подавать.',
                'photo' => '/assets/barmen.webp',
                'href'  => '/courses/barnoe-delo.html',
                'link'  => 'Перейти к курсам барменов',
            ],
            [
                'title' => 'Курсы для бизнеса',
                'short' => 'Для бизнеса',
                'text'  => 'Помогаем открыть кофейню с нуля: от проектирования барной зоны и подбора оборудования до разработки меню.',
                'photo' => '/assets/business.webp',
                'href'  => '/busines.html',
                'link'  => 'Перейти к курсам для бизнеса',
            ],
        ],

        // Короткие подписи под заголовком. Цифры вынесены в отдельный блок stats.
        'facts' => [
            'Обучение по образовательной лицензии',
            'Практика на профессиональном оборудовании',
            'Документ об обучении после курса',
        ],

        'card' => [
            'title' => 'Что вы получите',
            'items' => [
                ['title' => 'Практику на оборудовании', 'text' => 'Учитесь на профессиональных кофемашинах, а не по слайдам.'],
                ['title' => 'Документ об обучении',     'text' => 'Занятия идут по образовательной лицензии.'],
                ['title' => 'Поддержку после курса',    'text' => 'С тренером можно связаться и после выпуска.'],
            ],
            'link' => 'Посмотреть программы',
            'href' => '/courses.html',
        ],
    ],

    /* ---------- Школа в цифрах ---------- */
    'stats' => [
        'title' => 'Академия Бариста в цифрах',
        'lead'  => 'Учим профессии, а не теории: за каждой цифрой — люди, которые уже работают в кофейнях Москвы.',
        'items' => [
            ['value' => 1000, 'suffix' => '+', 'label' => 'выпускников',
             'note'  => 'прошли обучение в школе',
             'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3 2 8l10 5 10-5-10-5Z"/><path d="M6 10.5V16c0 1.7 2.7 3 6 3s6-1.3 6-3v-5.5"/></svg>'],

            ['value' => 4,    'suffix' => ' года', 'label' => 'в индустрии',
             'note'  => 'опыт работы кофейной школы',
             'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3.5 2"/></svg>'],

            ['value' => 90,   'suffix' => '%', 'label' => 'практики',
             'note'  => 'занятий за реальным оборудованием',
             'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19h13a4 4 0 0 0 0-8h-1"/><path d="M4 5h12v6a5 5 0 0 1-5 5H9a5 5 0 0 1-5-5V5Z"/></svg>'],

            ['value' => 13,   'suffix' => '',  'label' => 'программ',
             'note'  => 'от базового курса до управления',
             'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H19v15H6.5A2.5 2.5 0 0 0 4 20.5V5.5Z"/><path d="M9 8h6"/></svg>'],
        ],
    ],

    /* ---------- Рейтинги на площадках ---------- */
    'ratings' => [
        'demo' => true, // цифры кроме Яндекса — предварительные
        'items' => [
            ['title' => 'Яндекс Карты', 'score' => '5,0', 'count' => '270+ отзывов',
             'href' => 'https://yandex.ru/maps/org/39301833905/reviews'],
            ['title' => '2ГИС',         'score' => '5,0', 'count' => '—', 'href' => null],
            ['title' => 'Google Maps',  'score' => '5,0', 'count' => '—', 'href' => null],
            ['title' => 'Otzovik',      'score' => '4,9', 'count' => '—', 'href' => null],
        ],
    ],

    /* ---------- График занятий ---------- */
    'schedule' => [
        'title' => 'Выбирай удобный график занятий',
        'lead'  => 'Пропустили занятие? Отработаете его с другой группой бесплатно.',
        'items' => [
            [
                'title'   => 'По будням',
                'slots'   => ['Утром', 'Днём', 'Вечером'],
                'summary' => '2 дня по 4 часа',
                'note'    => 'Базовые курсы бариста',
            ],
            [
                'title'   => 'По выходным',
                'slots'   => ['Утро', 'Вечер'],
                'summary' => '1 день 8 часов',
                'note'    => 'Для тех, кто работает',
            ],
            [
                'title'   => 'Индивидуально',
                'slots'   => [],
                'summary' => 'Дату и время выбираете вы',
                'note'    => 'Занятие один на один с тренером',
            ],
        ],
    ],

    /* ---------- Как проходит обучение ---------- */
    'steps' => [
        'demo'  => true, // формулировки предварительные
        'title' => 'Как проходит обучение',
        'lead'  => 'От заявки до сертификата — четыре шага.',
        'items' => [
            ['n' => '01', 'title' => 'Заявка и подбор курса',
             'text' => 'Оставляете заявку, менеджер уточняет цель и подбирает программу под ваш уровень.'],
            ['n' => '02', 'title' => 'Теория с тренером',
             'text' => 'Разбираем кофе, оборудование и стандарты обслуживания. Без заучивания — сразу с примерами.'],
            ['n' => '03', 'title' => 'Практика на оборудовании',
             'text' => '90% курса — практика на профессиональных кофемашинах, а не лекции.'],
            ['n' => '04', 'title' => 'Сертификат и поддержка',
             'text' => 'Получаете документ об обучении и остаётесь на связи с тренером после курса.'],
        ],
    ],

    /* ---------- Преподаватели ---------- */
    'teachers' => [
        'title' => 'Наши преподаватели',
        'lead'  => 'Практикующие специалисты, которые умеют объяснять.',
        'items' => [
            [
                'name'   => 'Артём Тарлыков',
                'role'   => 'Управляющий кофейни, шеф-бармен, тренер',
                'photo'  => '/assets/artem.webp',
                'skills' => ['Управление кофейней', 'Барное дело', 'Подготовка бариста'],
                'demo'   => true, // список навыков предварительный
            ],
            [
                'name'   => 'Борис Пилюк',
                'role'   => 'Шеф-бариста, тренер, организатор кофейного бара',
                'photo'  => '/assets/boris.webp',
                'skills' => ['Эспрессо и альтернатива', 'Латте-арт', 'Запуск кофеен'],
                'demo'   => true,
            ],
            [
                'name'   => 'Чередниченко Кира',
                'role'   => 'Тренер бариста, SMM',
                'photo'  => '/assets/kira.webp',
                'skills' => ['Работа с гостем', 'Обучение с нуля', 'Продвижение кофеен'],
                'demo'   => true,
            ],
        ],
    ],

    'partners' => [
        'items' => array (
  0 => 
  array (
    'src' => 'data:image/webp;base64,UklGRigFAABXRUJQVlA4WAoAAAAYAAAAnwAAOgAAQUxQSJ4DAAABoJRte95WeiCIQT4GxwwsBjEDmYHK4AsDDYMPgoeBIBSCIQSCFr8+mbqrWUTEBCS7NNK0Cz1g10aAfLY9g/lsPxl1r3yW8s5JGHf50tdZLs2tcmEAyrW5OkvbBqR0w4CzMmgyJOVS+5neA/sFcpbhc7mn4nt5Ts4y+V4G/J1ox5U5K9PnPeXONreVC8MtFdeyuXzF9z3F1jnlSv/97pXlQ75DCOmyHPoChKb1YqifM7nhy9TWixB6cS6r6gUZ8JcZV+69B4Mjb1elOe2cALljcwr8eMVX33PWyZV18j0lQMpc7lilnfOe3sD+afu9FA/5Pg7puk9KSLmPwfBJb/ZfTvH5t5PKb2f2l3GOnL8TG/j+pYR3L32U9uINWG/9b4TPM678S3vP/VZcJ/NbIbfSZx299Q5ia506rvnufPeWO5AWU9bJlXVyS0rf3QFnledi513ljrWs9+bzDj/4OT6EEJa5rVNesJdurPyr9PN/YPT8nP6M65XyLv0FkDKa7ow8MHgytd6avyJMndwaee5kKtycnDNvmTq4OeQcOxdmsrs9xEayMPGOdAf+ze0ELLmbWnZhGnjmrht5hraMPENbBkBiPks5s/6hLzlbiiuD1g38n777mVRVAOcrESCq6gK4l4bKq4aBTVXVgVNVqZaUtoZbjqWxqaoHfFKpvKoAiwPx1UuTACLgfCW+satqtaQUql11wZDkQLTyK2C0kyAR0AeL9RTQB0hAzIGYI3ngK4UcDwGUpiiYg0XBHOwPSAr8syIG+BVEKz0aCgaIOdQDilNv4MM1LgGpRXxcgUSIC7gEYmBwjMQF/BPUwXNpSK4MSG5CG9baV3DWAKue14gC1tnXaxT0ARj4tWEj+qBptPcH5nv6GHJp90P6ADqS8r4bIN+WpJXNvubMXbI/R/Yh7727RlQmovd7ta1OqzRl+35IXte0gCgk3zCQOJY0ReYOTYmL0rquF+0yta7PKjmssqm0runLAGs57XGMrQ8GB+LDMbQ9B5TmFcrMClKZ94cDp1MKHFclcAk4qgeXBJqxSuC0cYzEB8gTkoPFw/5aW2lKjhCShyW24pyPrZf0vALmEP17PsFXAPTljy0tI17hJeADmMB+0DoElxnZV3AJ9rXlE3yFlmhSDYBLmlbkD5BUA4CoqQCbG9qAzYHzLfZkkVqe+ekAdlXdgJhSBNCUNmDdwG2AS8kEkD/gNtgAIhKAHWBLFgGiqjp+Us+PDFZQOCCGAAAAsAcAnQEqoAA7AD5NIoxEIqIhGM+cACgExLSDFAJ4Ak8QuHfilQNSk78UOnMR8EiQuPXdXBDlXfW/Y7QXeiN+qk0INrHOAAD+7QTFttCvQL+ojO/D0AUFJYymRanP0hf//Qci+bzicprXp4L//5/4+iSnvlR//QHwa3EteHOjsemxqfoAAABFWElG1gAAAEV4aWYAAElJKgAQAAAARXhpZk1ldGEGABIBAwABAAAAAQAAABoBBQABAAAAXgAAABsBBQABAAAAZgAAACgBAwABAAAAAgAAABMCAwABAAAAAQAAAGmHBAABAAAAbgAAAAAAAAAhHAAAZAAAACEcAABkAAAABwAAkAcABAAAADAyMTABkQcABAAAAAECAwAAoAcABAAAADAxMDABoAMAAQAAAP//AAACoAQAAQAAAKAAAAADoAQAAQAAADsAAAAApQUAAQAAAMgAAAAAAAAACwAAAAUAAAA=',
    'alt' => 'Партнер Петмол',
  ),
  1 => 
  array (
    'src' => 'data:image/webp;base64,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',
    'alt' => 'Gravitas Сoffee',
  ),
  2 => 
  array (
    'src' => 'data:image/webp;base64,UklGRgoFAABXRUJQVlA4WAoAAAAYAAAAlQAANgAAQUxQSMsDAAAB8JZtW5Zt27bNEWiw0uCwgTRYbSAN3BuwNSACZwMjLBGMQAQiTD9Aty+24fwbEROg/0ed345UTqu1MWy1mpV0bIv7o5aYz8q3Nst7+FPclq3x2Xr7ZGx5c39C+DAe1jMf+/p66bFb1veRz2vUXznMzYXSGDfL+0vfvLyTtQ5oZXezCqUxbGV/6ccusVTGZZuQ+2gM7Xjpx/toHdTi5xKMoe1Ov9TFk6Ht84hGb4fTr3bR6Os+B18BWl41QV8qQPUzyEBNTrOMFSiTKJpqgTyDCOdcMhwzWKDOxWCdgQMebPF26XyM2507Ugqdj/cuxLh1W4zhQYNlBqrwujNuUxcBN/qgr16K3K8BWCQP7HcO0BRPeH/VBaRBZHx9QgZZ+oCq+wDXHDIcdzGlC86UgiQPYIML8mutELSklBrklLwCNKcK+4MI5xwOKHeSCuwaZrggdBX+SeHKXn2Fl/oCKcKlhxnSHDa4vqhSA6TOAGz3Gj/w0CqsT054z8FD+5oAp2u0zlf6+u9TygBFTy9Y56AG7ksK7DIIkuSi0YdPuQb4R4CbxAXLl1TGWdKWdrlYIX1KCYqeLtA0yQL7V2zcNic1mpcKHJ+LkB4FsFlkyF9RoKSULnhLBtQG+G87oMwiQvkCB3hJB5jkK33b9W0Z0iwWuJ7EUoKkpZQkSa6UIknxtDN5jXMp7mYtZXtk8J6Fh/bkt1+wzEINXtMA3DQuWGaxQNM0C+xPXMx5H7mjpNAtsV/kYx/kYr9JPvbhLoDNI0N64CtA9ZL+NYAsKdEnBfoiT1+lSF/uDijziFAeVDhPMGmBViqkrplZ7Mzs6C6zMjCz4y5DmscG112AtxRp0kl1UqZ1pj6Aeg8v9ZGqxwbveXhod4lLkhZJjUOSh5cS/QBYO2Dv+tfdBes8BLjP9I1d0gLrDwLcRCosNxG85K04GSbpHzglrnVdu7auq+v2dXVdW9dVtx6aJnrCfuMa9YiVKkUo8QOKlDD1garewxHjNogxhpsANpMMx402hpuk/9FX/0VA7fpyE+GcyQHlTr5c9VzVR6tXcpKi5cFiZWR9kd7WHzcJ0kw2OB/86hP2mXioczBYZ+KAOTR4zUQVXlMANNUL9hkEuOZSgGv3v8sdBthcAsNzd7/FRWv0+1zkS2Vo+/Lz/GEMW/pP811LY1jLvvwcf5TGsNmqWb9LY9wsbct3+ZitMW5ld5r6mq9ufJ352MLinnkf4pHPysMrr/oL3Tvb6Gm95bPN8tvpL11itvbkK+uZ90V/s1veRypmtbZRq9XOko734vS7AQBWUDggOgAAANAEAJ0BKpYANwA+USiSRyOioaEgyABwCglpAAAGN7qb6NqHOMoB7qb6NqHOMn+gAP78+EAAAAAAAABFWElG1gAAAEV4aWYAAElJKgAQAAAARXhpZk1ldGEGABIBAwABAAAAAQAAABoBBQABAAAAXgAAABsBBQABAAAAZgAAACgBAwABAAAAAgAAABMCAwABAAAAAQAAAGmHBAABAAAAbgAAAAAAAAAhHAAAZAAAACEcAABkAAAABwAAkAcABAAAADAyMTABkQcABAAAAAECAwAAoAcABAAAADAxMDABoAMAAQAAAP//AAACoAQAAQAAAJYAAAADoAQAAQAAADcAAAAApQUAAQAAAMgAAAAAAAAACwAAAAUAAAA=',
    'alt' => 'Tasty coffe',
  ),
  3 => 
  array (
    'src' => 'data:image/webp;base64,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',
    'alt' => 'Planto',
  ),
  4 => 
  array (
    'src' => 'data:image/webp;base64,UklGRm4DAABXRUJQVlA4WAoAAAAYAAAAlQAANgAAQUxQSC8CAAABoFXbVp6x2hJw0OOgcRAkxAFxkDjgc0AdnDqIBCQg4UhAwn44hKS/9z51RMQE4F/Z+fz/vKiqmgXAogeAElxQHYTPdSUBFi3uyPKg27OgqpqXwaaqmmUUDq1FBruqapIfs3OYgMgKgOqEdGcnSdsQ2ZxxnSsB0p4IhxoAZA4/bjH64pTe5Ae1nJU93PEzsZP1OIyCyPqGIWywZz3ni2yDlrOSAZBOK4eSZXDlbKwvnHFGARiXCW53xgwAK+7aA0Vh4zMDsHRmpwAqD6CyBQA7GV0ChAyj01oaiNUnjetMl9FOw+1NfdAgvaeUjheQaXcXDwgp8Eq9CXc7SZ7uQ8aJK8ZvpEx8p4VBYZ7ptdbaHzAiGgB5I5ABmZdI7FyxsWIYaS7H+J2GoTkDIEbWiWHGRGisA2WauZ1TAGdFtjdAfnGdZAF2XiMh3XAbcQjgQ5Lxrtd6rZiBGC9XmGdaSin1ByJVkJH5RiADMvUkC1wbRZrrremKsbkGSHf1TjGewEK6nXWmAoDNGTZaAK5XdhocLlYAQspAebmE2dMlQDmMPwDnIHR+XHyLIRgvwN5YjGkUjCeAyhYAbOT6DHutB4A0/iEoDhvZjqNxeSsjrAGQ/qAfh5KGESIZAem0vCtZ8MK7b6E67J0k+/YWP4JYP7I/GNZwh0ILwGL0ip9lyduNaAagOgjqILvqEQDJyRX9Ojd/E1RVywq/aQKAogcA2WvVFX7X+ON+2ff+9P+v/IMtAFZQOCA6AAAA0AQAnQEqlgA3AD5RKJJHI6KhoSDIAHAKCWkAAAY3upvo2oc4ygHupvo2oc4yf6AA/vz4QAAAAAAAAEVYSUbWAAAARXhpZgAASUkqABAAAABFeGlmTWV0YQYAEgEDAAEAAAABAAAAGgEFAAEAAABeAAAAGwEFAAEAAABmAAAAKAEDAAEAAAACAAAAEwIDAAEAAAABAAAAaYcEAAEAAABuAAAAAAAAACEcAABkAAAAIRwAAGQAAAAHAACQBwAEAAAAMDIxMAGRBwAEAAAAAQIDAACgBwAEAAAAMDEwMAGgAwABAAAA//8AAAKgBAABAAAAlgAAAAOgBAABAAAANwAAAAClBQABAAAAyAAAAAAAAAALAAAABQAAAA==',
    'alt' => 'Сиропы Pinch Drop',
  ),
  5 => 
  array (
    'src' => 'data:image/webp;base64,UklGRpIEAABXRUJQVlA4WAoAAAAYAAAAlQAANgAAQUxQSFMDAAABkBXbdthWhiAGFgQzqBgkDBIGegxUBn4MBCEQBMEQDMEQNFOfe861O9V3REBwJDlu00uBvj3D5ZJ08oNpnBFSrp+GEYbxSG6dxjwG4nr0PhzC98+t8ZD23gfEv+6JI/x5vtkQ1Ndia34cV3ucz43m2r+mkcTTXGsYyhV3pExjiTqmK43pmnbg49xmlIpIggniKqKW7amP6HByKlEu2Hv26FwSAmfrLLYX8qQjWXqSddI0byVtPVW/qFIYgpMGvLzZKyqZJuj4vWFxRT69ycE8PE6qqCQ/Ea3pyzg9gkC1QCA5THL0ZkfpHOEesre32ctX6EVydNYZSUlRT7X30OT2L6W1SxzBwnQmJfPlcXLcQugn9crymSSwF4aCmRUkPnpG0SpY0ckdJODh7HGgXNjUroKsvO5mnXMkuV3HWogu3nZ6uDB6q2BFr0L27nLSl8sYPYd3UccoToqH1rETsjnNsF7GKGze/c90EnqQyILNTDWRj5mxsOq8zuZ/5Qd0e2bo+j4DnUeBNRtNhnWlVOIkX2cXaF0ZMuj/oDpxFiXHkGXV4ujdj9BZAwzp4t5TouDZSUclVsQqrKgo3Q93HrGY1pv230ImRkE1IHPT1VCg+w24yYBV4WINVCApgIw6N3B58Bp9mu0C0x5uedvmYEOZRlem5K/S0Q/HKgy4lqCpzeojg/Wyy2n5nXUyYUX8xH9ItPognB4azEhiZwb0tPBXZ+vkuGdPmR2vVpEEBaeTIhgBjUx3c5b0OnlcJAFZf7KkCQJ2ioTbLemK0bSaCtVObjmrNP1qHYHuKaSjEOuki6awqttJIuSIQSDio2B3UAQBtQhWzLXtKvHmdrI65lOlFHTm6PdiYsWEiP23ohbOh4hqZHhJPSVQIJ1cI/BzkjizYZhSfwiS42SOy89iRVWWmdm6rspYuQK5W/Wro8XsAuqs0nAIKXhesqIiU/ewThZCBtMXSWzWiyObwZb6TCFHZ4udu0iyqqvhKY/DARwsbjYcSf3zeP6JiUY4hdgvoNpmKyDYLzCiiAAhzunEhFJPuy1Mg4nPoFrYTYtj+htV39NgWiH1FwfVel0G1fpec1riX44g2jhiV/8/GhNTrANB3hgG+kbeBoHngUep7W/HOg0qJgBWUDggOgAAANAEAJ0BKpYANwA+USiSRyOioaEgyABwCglpAAAGN7qb6NqHOMoB7qb6NqHOMn+gAP78+EAAAAAAAABFWElG1gAAAEV4aWYAAElJKgAQAAAARXhpZk1ldGEGABIBAwABAAAAAQAAABoBBQABAAAAXgAAABsBBQABAAAAZgAAACgBAwABAAAAAgAAABMCAwABAAAAAQAAAGmHBAABAAAAbgAAAAAAAAAhHAAAZAAAACEcAABkAAAABwAAkAcABAAAADAyMTABkQcABAAAAAECAwAAoAcABAAAADAxMDABoAMAAQAAAP//AAACoAQAAQAAAJYAAAADoAQAAQAAADcAAAAApQUAAQAAAMgAAAAAAAAACwAAAAUAAAA=',
    'alt' => 'Кофемашина Carimali',
  ),
  6 => 
  array (
    'src' => 'data:image/webp;base64,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',
    'alt' => 'Кофемашина Elektra',
  ),
),
    ],

    'reviews' => [
        'items' => array (
  0 => 
  array (
    'name' => 'Кира Сурогина',
    'date' => '15 декабря 2024',
    'text' => 'Проходила курс «бариста продвинутый» все очень понравилось, ребята приветливые , все очень классно, приятная атмосфера , все понятно и интересно , классная подача',
    'rating' => 5,
    'href' => 'https://yandex.ru/maps/org/39301833905/reviews?reviews%5BpublicId%5D=xkt24kpew4yqebjd2g33g6dnhg&si=5rm3pv9jexuu3gvw5nwcr7vc2c&utm_source=review',
  ),
  1 => 
  array (
    'name' => 'Евгений Поляков',
    'date' => '26 октября 2024',
    'text' => 'Проходил обучение в "Академия бариста", очень доволен результатом. Преподаватели объясняют просто и понятно, одним словом профессионалы своего дела. Всем те кто желает освоить профессию " Бариста" Очень советую посетить.)))',
    'rating' => 5,
    'href' => 'https://yandex.ru/maps/org/39301833905/reviews?reviews%5BpublicId%5D=7fvy84jz262brc050uatygx91g&si=5rm3pv9jexuu3gvw5nwcr7vc2c&utm_source=review',
  ),
  2 => 
  array (
    'name' => 'Надежда Созинова',
    'date' => '1 ноября 2024',
    'text' => 'Ходила с подругой на мастер класс бариста домашний. Узнала много нового и интересного о кофе и способов заваривания. Объясняют всё доступно, на понятном языке. Помогают, если что-то не получается. Всем советую. Даже людям, ничего не смыслящим в приготовлении кофе, всё далось очень легко',
    'rating' => 5,
    'href' => 'https://yandex.ru/maps/org/39301833905/reviews?reviews%5BpublicId%5D=phyunj1zmbhwd4jw07bq0at8pr&si=5rm3pv9jexuu3gvw5nwcr7vc2c&utm_source=review',
  ),
  3 => 
  array (
    'name' => 'Вероника Порецкая',
    'date' => '7 февраля 2024',
    'text' => 'Мне очень понравился курс! Прекрасный тренер Виталий Козлов, всё понятно, позитивно и интересно. Очень понравился подход к работе и ученикам. Много практики и полезной информации! Всем советую.',
    'rating' => 5,
    'href' => 'https://yandex.ru/maps/org/39301833905/reviews?reviews%5BpublicId%5D=r9zhhtvwjeng2huwuy04jwg4ac&si=5rm3pv9jexuu3gvw5nwcr7vc2c&utm_source=review',
  ),
  4 => 
  array (
    'name' => 'Ирина Степняк',
    'date' => '14 февраля 2024',
    'text' => 'Крутой мастер класс, спасибо теперь знаю какой кофе выбрать для себя, а так же вернусь что бы при их помощи открыть свою кофейню, все доходчиво и индивидуально',
    'rating' => 5,
    'href' => 'https://yandex.ru/maps/org/39301833905/reviews?reviews%5BpublicId%5D=xkt24kpew4yqebjd2g33g6dnhg&si=5rm3pv9jexuu3gvw5nwcr7vc2c&utm_source=review',
  ),
),
    ],

    'faq' => [
        'items' => array (
  0 => 
  array (
    'q' => 'Какие навыки я получу на курсах бариста для начинающих?',
    'a' => 'За пару дней обучения вы пройдете путь от теории происхождения зерна и настройки помола до профессиональной работы с оборудованием, освоив технику приготовления классических напитков и искусство создания правильной текстуры молочной пены.',
  ),
  1 => 
  array (
    'q' => 'Выдаете ли вы сертификат после окончания курсов?',
    'a' => 'Да, каждый выпускник нашей академии получает именной сертификат, подтверждающий прохождение профессиональной подготовки.',
  ),
  2 => 
  array (
    'q' => 'Сколько длится обучение и какой график занятий?',
    'a' => 'Мы предлагаем гибкий график обучения: после получения заявки мы связываемся с вами и подбираем максимально удобные даты и время занятий. Курсы бариста проходят интенсивно за 1-2 дня, а остальные программы обучения можно успешно завершить всего за 1 день.',
  ),
  3 => 
  array (
    'q' => 'Есть ли у вас курсы для тех, кто хочет открыть свою кофейню?',
    'a' => 'Да, у нас есть специализированные программы для тех, кто уже владеет или только планирует открыть кофейню: мы поможем разобрать все тонкости бизнеса, от проектирования бара и разработки авторского меню до подбора и обучения персонала, обеспечивая экспертную поддержку на каждом этапе открытия с нуля.',
  ),
  4 => 
  array (
    'q' => 'Нужно ли покупать свое оборудование и расходники для занятий?',
    'a' => 'Нет, всё профессиональное оборудование (кофемашины, кофемолки) и расходные материалы (свежеобжаренное зерно, молоко) уже включены в стоимость курса.',
  ),
),
    ],
];
