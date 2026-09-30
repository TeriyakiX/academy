<?php

namespace App\Support;

/*
 | Меню сайта.
 |
 | Списки программ в шапке и подвале раньше были записаны вручную и
 | расходились с каталогом: курс переименовали, а в меню осталось
 | прежнее название. Теперь пункты с ключом «school» собираются из
 | того же каталога, что и карточки.
 */
class Navigation
{
    /** Главное меню: у пунктов-направлений список программ подставляется. */
    public static function main(): array
    {
        return array_map(static function (array $item) {
            if (empty($item['school'])) {
                return $item;
            }

            $item['children'] = array_merge(
                $item['children'] ?? [],
                self::programs($item['school'])
            );

            unset($item['school']);

            return $item;
        }, config('nav.main', []));
    }

    /** Колонки подвала: название направления → список программ. */
    public static function footer(): array
    {
        $columns = [];

        foreach (config('nav.footer', []) as $title => $links) {
            $columns[$title] = is_string($links) ? self::programs($links) : $links;
        }

        return $columns;
    }

    /** @return array<int, array{title: string, href: string}> */
    private static function programs(string $school): array
    {
        /* В меню берём короткое имя, если оно задано: полные названия
           мастер-классов и коктейлей в список не помещаются. */
        return array_map(
            static fn (array $course) => [
                'title' => $course['short'] ?? $course['title'],
                'href'  => $course['url'],
            ],
            config('courses.schools.' . $school, [])
        );
    }
}
