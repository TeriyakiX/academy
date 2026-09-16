<?php

namespace App\Support;

/*
 | Программа курса по дням.
 |
 | В исходных данных темы курса записаны двумя списками — теория и
 | практика, без разбивки по дням. На странице их показываем по дням:
 | «День 1: теория, практика», «День 2: …» — так человеку понятнее,
 | что его ждёт на каждом занятии.
 |
 | Раскладка по дням идёт по порядку тем: темы в списках уже записаны
 | от простого к сложному. Если школа укажет точное распределение,
 | его можно задать в config/course-pages.php ключом «days» — тогда
 | автоматическая раскладка не используется.
 |
 | Короткие занятия (мастер-классы на 3–4 часа) на дни не делятся:
 | у них одно занятие с программой и результатом.
 */
class CourseSchedule
{
    /** Подписи групп на странице: в данных они длиннее. */
    private const LABELS = [
        'Теоретическая часть' => 'Теория',
        'Практическая часть'  => 'Практика',
        'План обучения'       => 'Программа',
        'В программу входит'  => 'Программа',
        'Результаты'          => 'Результат',
    ];

    private const ICONS = [
        'Теория'    => 'theory',
        'Практика'  => 'practice',
        'Программа' => 'theory',
        'Результат' => 'result',
    ];

    /**
     * @param  array<int, array{title: string, topics?: array<int, string>}>  $program
     * @param  array<int, array>|null  $explicit  готовая раскладка из настроек
     * @return array<int, array{label: string, groups: array<int, array{title: string, icon: string, items: array<int, string>}>}>
     */
    public static function days(array $program, ?string $duration, ?array $explicit = null): array
    {
        if ($explicit) {
            return $explicit;
        }

        $groups = collect($program)
            ->map(fn ($block) => [
                'title' => self::LABELS[$block['title']] ?? $block['title'],
                'items' => array_values($block['topics'] ?? []),
            ])
            ->filter(fn ($g) => count($g['items']) > 0)
            ->map(fn ($g) => $g + ['icon' => self::ICONS[$g['title']] ?? 'theory'])
            ->values()
            ->all();

        $count = self::dayCount($duration);

        /* Мастер-класс или курс без деления на теорию и практику —
           одно занятие целиком. */
        $split = $count > 1 && collect($groups)->pluck('title')->contains('Теория');

        if (!$split) {
            return [['label' => $count > 1 ? 'Программа' : 'Занятие', 'groups' => $groups]];
        }

        $days = [];

        for ($day = 0; $day < $count; $day++) {
            $days[] = [
                'label'  => 'День ' . ($day + 1),
                'groups' => collect($groups)
                    ->map(fn ($g) => ['items' => self::chunk($g['items'], $count)[$day] ?? []] + $g)
                    ->filter(fn ($g) => count($g['items']) > 0)
                    ->values()
                    ->all(),
            ];
        }

        return $days;
    }

    /** «2 дня по 4 часа» → 2, «4 часа» → 1. */
    public static function dayCount(?string $duration): int
    {
        return preg_match('~(\d+)\s*д~u', (string) $duration, $m) ? max(1, (int) $m[1]) : 1;
    }

    /**
     * Делит список на части почти поровну, сохраняя порядок.
     * Лишние темы достаются первым дням: 11 тем на 2 дня — это 6 и 5.
     */
    private static function chunk(array $items, int $parts): array
    {
        $size  = intdiv(count($items), $parts);
        $extra = count($items) % $parts;
        $out   = [];
        $pos   = 0;

        for ($i = 0; $i < $parts; $i++) {
            $take  = $size + ($i < $extra ? 1 : 0);
            $out[] = array_slice($items, $pos, $take);
            $pos  += $take;
        }

        return $out;
    }
}
