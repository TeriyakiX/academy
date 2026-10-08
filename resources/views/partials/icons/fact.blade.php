@php
    /*
     | Значок к характеристике курса. Подписи приходят из методичек школы,
     | поэтому подбираем по ключевому слову, а не по точному совпадению:
     | «длительность» и «продолжительность» — один и тот же значок.
     */
    $key = mb_strtolower($key ?? '');

    $name = match (true) {
        str_contains($key, 'длительн'), str_contains($key, 'продолжительн'), str_contains($key, 'срок') => 'clock',
        str_contains($key, 'стоимост'), str_contains($key, 'цена') => 'price',
        str_contains($key, 'время'), str_contains($key, 'когда'), str_contains($key, 'расписан') => 'calendar',
        str_contains($key, 'группы'), str_contains($key, 'групп') => 'users',
        str_contains($key, 'для кого'), str_contains($key, 'кому') => 'user',
        str_contains($key, 'возраст') => 'age',
        str_contains($key, 'уровень') => 'levels',
        str_contains($key, 'формат') => 'cup',
        str_contains($key, 'сопровожд'), str_contains($key, 'поддержк') => 'chat',
        str_contains($key, 'автоматизац'), str_contains($key, 'систем') => 'monitor',
        str_contains($key, 'документ'), str_contains($key, 'свидетельств') => 'doc',
        str_contains($key, 'унесёт'), str_contains($key, 'унесет'), str_contains($key, 'с собой') => 'gift',
        str_contains($key, 'не входит') => 'info',
        str_contains($key, 'как проходит'), str_contains($key, 'обучение') => 'route',
        str_contains($key, 'что будет') => 'list',
        default => 'bean',
    };
@endphp

<svg class="ab-ficon" viewBox="0 0 24 24" aria-hidden="true">
    @switch($name)
        @case('price')
            <path d="M4.5 10.5 11.3 3.7a2.4 2.4 0 0 1 1.7-.7h5.1a1.9 1.9 0 0 1 1.9 1.9v5.1a2.4 2.4 0 0 1-.7 1.7l-6.8 6.8a1.9 1.9 0 0 1-2.7 0l-5.3-5.3a1.9 1.9 0 0 1 0-2.7Z" />
            <path d="M16.5 7.5h.01" />
            @break

        @case('age')
            <circle cx="12" cy="12" r="8.5" />
            <path d="M12 7.5v5M12 16h.01" />
            @break

        @case('clock')
            <circle cx="12" cy="12" r="8.5" />
            <path d="M12 7.5V12l3 2" />
            @break

        @case('calendar')
            <rect x="3.5" y="5.5" width="17" height="15" rx="2.5" />
            <path d="M3.5 10h17M8 3.5v4M16 3.5v4" />
            @break

        @case('users')
            <circle cx="9" cy="9" r="3.5" />
            <path d="M3 19.5c0-3.3 2.7-5.5 6-5.5s6 2.2 6 5.5" />
            <path d="M16 6.2a3.5 3.5 0 0 1 0 6.6M17.5 14.6c2 .8 3.5 2.6 3.5 4.9" />
            @break

        @case('user')
            <circle cx="12" cy="8.5" r="4" />
            <path d="M4.5 20c0-3.6 3.4-6 7.5-6s7.5 2.4 7.5 6" />
            @break

        @case('levels')
            <path d="M4 20V13M10 20V8M16 20v-9M22 20V4" />
            @break

        @case('cup')
            <path d="M4 8h13v5.5a5.5 5.5 0 0 1-5.5 5.5h-2A5.5 5.5 0 0 1 4 13.5V8Z" />
            <path d="M17 9.5h1.5a2.75 2.75 0 0 1 0 5.5H16" />
            <path d="M8 2.5c0 1.6 1 1.6 1 3.2M12 2.5c0 1.6 1 1.6 1 3.2" />
            @break

        @case('chat')
            <path d="M20.5 12.5c0 3.9-3.8 7-8.5 7-1 0-2-.1-2.9-.4L4 20.5l1.5-3.6C4.1 15.7 3.5 14.2 3.5 12.5c0-3.9 3.8-7 8.5-7s8.5 3.1 8.5 7Z" />
            @break

        @case('monitor')
            <rect x="3" y="4.5" width="18" height="12" rx="2" />
            <path d="M9 20.5h6M12 16.5v4" />
            @break

        @case('doc')
            <path d="M6 3.5h7.5L19 9v11.5H6V3.5Z" />
            <path d="M13 3.5V9h6M9 13h6M9 16.5h4" />
            @break

        @case('gift')
            <path d="M3.5 10.5h17V20a1.5 1.5 0 0 1-1.5 1.5H5A1.5 1.5 0 0 1 3.5 20v-9.5Z" />
            <path d="M2.5 6.5h19v4h-19zM12 6.5v15" />
            <path d="M12 6.5S10.6 2.5 8.4 2.5a2 2 0 0 0 0 4M12 6.5s1.4-4 3.6-4a2 2 0 0 1 0 4" />
            @break

        @case('info')
            <circle cx="12" cy="12" r="8.5" />
            <path d="M12 11v5.5M12 7.8v.4" />
            @break

        @case('route')
            <circle cx="6" cy="6" r="2.5" />
            <circle cx="18" cy="18" r="2.5" />
            <path d="M8.5 6H14a3.5 3.5 0 0 1 0 7h-4a3.5 3.5 0 0 0 0 7h5.5" />
            @break

        @case('list')
            <path d="M9 6.5h11M9 12h11M9 17.5h11M4.2 6.5h.01M4.2 12h.01M4.2 17.5h.01" />
            @break

        @default
            <ellipse cx="12" cy="12" rx="6.5" ry="9" transform="rotate(35 12 12)" />
            <path d="M8.8 6c2.7 2.3.9 5 3.2 6.4 2.3 1.4 1.4 3.6 3.2 5.4" />
    @endswitch
</svg>
