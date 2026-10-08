<?php

namespace App\Support;

use Illuminate\Support\Str;

/*
 | Отзыв под курс.
 |
 | Отзывы приходят с Яндекс.Карт одним списком и ни к чему не привязаны.
 | Подбираем по ключевым словам: сначала ищем упоминание самого курса,
 | потом — направления, иначе берём свежий общий.
 */
class CourseReviews
{
    /** Слова, по которым отзыв относится к конкретному курсу. */
    private const BY_COURSE = [
        'barista-novichok'        => ['новичок', 'с нуля', 'первый раз', 'впервые'],
        'barista-base'            => ['базовый', 'база', 'основы'],
        'barista-base-group'      => ['базовый', 'группе', 'группой'],
        'barista-advanced'        => ['продвинут', 'альтернатив', 'пуровер', 'кемекс', 'харио', 'воронк'],
        'barista-technician'      => ['техник', 'ремонт', 'обслуживан', 'кофемашин', 'диагностик'],
        'upravlyayushchiy-kofeyni' => ['управляющ', 'кофейн', 'бизнес', 'себестоимост', 'команд'],
        'young-barista'           => ['ребён', 'ребен', 'подрост', 'сын', 'дочь', 'юный'],
        'latte-art'               => ['латте-арт', 'латте арт', 'рисун', 'молок'],
        'alternativnye-metody'    => ['альтернатив', 'заварива', 'кемекс', 'харио', 'пуровер', 'воронк'],
        'domashniy-barista'       => ['дома', 'домашн', 'для себя'],
        'vstryakhni-i-poday'      => ['коктейл', 'шейк', 'бармен'],
        'metod-ctir'              => ['коктейл', 'стир', 'бармен'],
        'koktel-metodom-bild'     => ['коктейл', 'билд', 'бармен'],
    ];

    /** Слова направления — запасной вариант, если про курс никто не писал. */
    private const BY_SCHOOL = [
        'Курсы бариста' => ['бариста', 'кофе', 'эспрессо'],
        'Мастер-классы' => ['мастер-класс', 'мастер класс'],
    ];

    /** @return array<string, mixed>|null */
    public static function pick(array $course): ?array
    {
        $reviews = array_values(config('home.reviews.items', []));

        if (!$reviews) {
            return null;
        }

        $id = $course['id'] ?? basename($course['url'] ?? '', '.html');

        return self::match($reviews, self::BY_COURSE[$id] ?? [])
            ?? self::match($reviews, self::BY_SCHOOL[$course['school'] ?? ''] ?? [])
            ?? $reviews[0];
    }

    /**
     * Первый отзыв, где встречается любое из слов.
     *
     * @param  array<int, array<string, mixed>>  $reviews
     * @param  array<int, string>  $words
     * @return array<string, mixed>|null
     */
    private static function match(array $reviews, array $words): ?array
    {
        if (!$words) {
            return null;
        }

        foreach ($reviews as $review) {
            $text = Str::lower($review['text'] ?? '');

            foreach ($words as $word) {
                if (str_contains($text, $word)) {
                    return $review;
                }
            }
        }

        return null;
    }
}
